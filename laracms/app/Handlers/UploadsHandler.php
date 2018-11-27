<?php

/**
 * 分装自定义文件上传
 */
namespace App\Handlers;

use Image;
use Illuminate\HTTP\File;
use Illuminate\Support\Facades\Storage;
use App\Models\File as FileModel;

/**
 * 文件上传工具类
 *
 * Class UploadHandler
 * @package App\Handlers
 */

//获取key
// protected $key = config('administrator.key');
/**
 * Created by JetBrains PhpStorm.
 * User: taoqili
 * Date: 12-7-18
 * Time: 上午11: 32
 * UEditor编辑器通用上传类
 */
class UploadsHandler
{
    private $fileField; //文件域名
    private $file; //文件上传对象
    private $base64; //文件上传对象
    private $config; //配置信息
    private $oriName; //原始文件名
    private $fileName; //新文件名
    private $fullName; //完整文件名,即从当前配置目录开始的URL
    private $filePath; //完整文件名,即从当前配置目录开始的URL
    private $fileSize; //文件大小
    private $fileType; //文件类型
    private $stateInfo; //上传状态信息,
    private $stateMap = array( //上传状态映射表，国际化用户需考虑此处数据的国际化
        "SUCCESS", //上传成功标记，在UEditor中内不可改变，否则flash判断会出错
        "文件大小超出 upload_max_filesize 限制",
        "文件大小超出 MAX_FILE_SIZE 限制",
        "文件未被完整上传",
        "没有文件被上传",
        "上传文件为空",
        "ERROR_TMP_FILE" => "临时文件错误",
        "ERROR_TMP_FILE_NOT_FOUND" => "找不到临时文件",
        "ERROR_SIZE_EXCEED" => "文件大小超出网站限制",
        "ERROR_TYPE_NOT_ALLOWED" => "文件类型不允许",
        "ERROR_CREATE_DIR" => "目录创建失败",
        "ERROR_DIR_NOT_WRITEABLE" => "目录没有写权限",
        "ERROR_FILE_MOVE" => "文件保存时出错",
        "ERROR_FILE_NOT_FOUND" => "找不到上传文件",
        "ERROR_WRITE_CONTENT" => "写入文件内容错误",
        "ERROR_UNKNOWN" => "未知错误",
        "ERROR_DEAD_LINK" => "链接不可用",
        "ERROR_HTTP_LINK" => "链接不是http链接",
        "ERROR_HTTP_CONTENTTYPE" => "链接contentType不正确",
        "INVALID_URL" => "非法 URL",
        "INVALID_IP" => "非法 IP"
    );

    /**
     * 构造函数
     * @param string $fileField 表单名称
     * @param array $config 配置项
     * @param bool $base64 是否解析base64编码，可省略。若开启，则$fileField代表的是base64编码的字符串表单名
     */
    public function __construct($fileField, $config, $type = "upload")
    {
        $this->fileField = $fileField;
        $this->config = $config;
        $this->type = $type;
        if ($type == "remote") {
            $this->saveRemote();
        } else if($type == "base64") {
            $this->upBase64();
        } else {
            $this->upFile();
        }

        $this->stateMap['ERROR_TYPE_NOT_ALLOWED'] = iconv('unicode', 'utf-8', $this->stateMap['ERROR_TYPE_NOT_ALLOWED']);
    }

    /**
     * 上传文件的主处理方法
     * @return mixed
     */
    private function upFile()
    {
        $file = $this->file = $_FILES[$this->fileField];
        if (!$file) {
            $this->stateInfo = $this->getStateInfo("ERROR_FILE_NOT_FOUND");
            return;
        }
        if ($this->file['error']) {
            $this->stateInfo = $this->getStateInfo($file['error']);
            return;
        } else if (!file_exists($file['tmp_name'])) {
            $this->stateInfo = $this->getStateInfo("ERROR_TMP_FILE_NOT_FOUND");
            return;
        } else if (!is_uploaded_file($file['tmp_name'])) {
            $this->stateInfo = $this->getStateInfo("ERROR_TMPFILE");
            return;
        }

        $this->oriName = $file['name'];
        $this->fileSize = $file['size'];
        $this->fileType = $this->getFileExt();
        $this->fullName = $this->getFullName();
        $this->filePath = $this->getFilePath();
        $this->fileName = $this->getFileName();
        $dirname = dirname($this->filePath);

        //检查文件大小是否超出限制
        if (!$this->checkSize()) {
            $this->stateInfo = $this->getStateInfo("ERROR_SIZE_EXCEED");
            return;
        }

        //检查是否不允许的文件格式
        if (!$this->checkType()) {
            $this->stateInfo = $this->getStateInfo("ERROR_TYPE_NOT_ALLOWED");
            return;
        }

        //创建目录失败
        if (!file_exists($dirname) && !mkdir($dirname, 0777, true)) {
            $this->stateInfo = $this->getStateInfo("ERROR_CREATE_DIR");
            return;
        } else if (!is_writeable($dirname)) {
            $this->stateInfo = $this->getStateInfo("ERROR_DIR_NOT_WRITEABLE");
            return;
        }

        //移动文件
        if (!(move_uploaded_file($file["tmp_name"], $this->filePath) && file_exists($this->filePath))) { //移动失败
            $this->stateInfo = $this->getStateInfo("ERROR_FILE_MOVE");
        } else { //移动成功
            $this->stateInfo = $this->stateMap[0];
        }
    }

    /**
     * 处理base64编码的图片上传
     * @return mixed
     */
    private function upBase64()
    {
        $base64Data = $_POST[$this->fileField];
        $img = base64_decode($base64Data);

        $this->oriName = $this->config['oriName'];
        $this->fileSize = strlen($img);
        $this->fileType = $this->getFileExt();
        $this->fullName = $this->getFullName();
        $this->filePath = $this->getFilePath();
        $this->fileName = $this->getFileName();
        $dirname = dirname($this->filePath);

        //检查文件大小是否超出限制
        if (!$this->checkSize()) {
            $this->stateInfo = $this->getStateInfo("ERROR_SIZE_EXCEED");
            return;
        }

        //创建目录失败
        if (!file_exists($dirname) && !mkdir($dirname, 0777, true)) {
            $this->stateInfo = $this->getStateInfo("ERROR_CREATE_DIR");
            return;
        } else if (!is_writeable($dirname)) {
            $this->stateInfo = $this->getStateInfo("ERROR_DIR_NOT_WRITEABLE");
            return;
        }

        //移动文件
        if (!(file_put_contents($this->filePath, $img) && file_exists($this->filePath))) { //移动失败
            $this->stateInfo = $this->getStateInfo("ERROR_WRITE_CONTENT");
        } else { //移动成功
            $this->stateInfo = $this->stateMap[0];
        }

    }

    /**
     * 拉取远程图片
     * @return mixed
     */
    private function saveRemote()
    {
        $imgUrl = htmlspecialchars($this->fileField);
        $imgUrl = str_replace("&amp;", "&", $imgUrl);

        //http开头验证
        if (strpos($imgUrl, "http") !== 0) {
            $this->stateInfo = $this->getStateInfo("ERROR_HTTP_LINK");
            return;
        }

        preg_match('/(^https*:\/\/[^:\/]+)/', $imgUrl, $matches);
        $host_with_protocol = count($matches) > 1 ? $matches[1] : '';

        // 判断是否是合法 url
        if (!filter_var($host_with_protocol, FILTER_VALIDATE_URL)) {
            $this->stateInfo = $this->getStateInfo("INVALID_URL");
            return;
        }

        preg_match('/^https*:\/\/(.+)/', $host_with_protocol, $matches);
        $host_without_protocol = count($matches) > 1 ? $matches[1] : '';

        // 此时提取出来的可能是 ip 也有可能是域名，先获取 ip
        $ip = gethostbyname($host_without_protocol);
        // 判断是否是私有 ip
        if(!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE)) {
            $this->stateInfo = $this->getStateInfo("INVALID_IP");
            return;
        }

        //获取请求头并检测死链
        $heads = get_headers($imgUrl, 1);
        if (!(stristr($heads[0], "200") && stristr($heads[0], "OK"))) {
            $this->stateInfo = $this->getStateInfo("ERROR_DEAD_LINK");
            return;
        }
        //格式验证(扩展名验证和Content-Type验证)
        $fileType = strtolower(strrchr($imgUrl, '.'));
        if (!in_array($fileType, $this->config['allowFiles']) || !isset($heads['Content-Type']) || !stristr($heads['Content-Type'], "image")) {
            $this->stateInfo = $this->getStateInfo("ERROR_HTTP_CONTENTTYPE");
            return;
        }

        //打开输出缓冲区并获取远程图片
        ob_start();
        $context = stream_context_create(
            array('http' => array(
                'follow_location' => false // don't follow redirects
            ))
        );
        readfile($imgUrl, false, $context);
        $img = ob_get_contents();
        ob_end_clean();
        preg_match("/[\/]([^\/]*)[\.]?[^\.\/]*$/", $imgUrl, $m);

        $this->oriName = $m ? $m[1]:"";
        $this->fileSize = strlen($img);
        $this->fileType = $this->getFileExt();
        $this->fullName = $this->getFullName();
        $this->filePath = $this->getFilePath();
        $this->fileName = $this->getFileName();
        $dirname = dirname($this->filePath);

        //检查文件大小是否超出限制
        if (!$this->checkSize()) {
            $this->stateInfo = $this->getStateInfo("ERROR_SIZE_EXCEED");
            return;
        }

        //创建目录失败
        if (!file_exists($dirname) && !mkdir($dirname, 0777, true)) {
            $this->stateInfo = $this->getStateInfo("ERROR_CREATE_DIR");
            return;
        } else if (!is_writeable($dirname)) {
            $this->stateInfo = $this->getStateInfo("ERROR_DIR_NOT_WRITEABLE");
            return;
        }

        //移动文件
        if (!(file_put_contents($this->filePath, $img) && file_exists($this->filePath))) { //移动失败
            $this->stateInfo = $this->getStateInfo("ERROR_WRITE_CONTENT");
        } else { //移动成功
            $this->stateInfo = $this->stateMap[0];
        }

    }

    /**
     * 上传错误检查
     * @param $errCode
     * @return string
     */
    private function getStateInfo($errCode)
    {
        return !$this->stateMap[$errCode] ? $this->stateMap["ERROR_UNKNOWN"] : $this->stateMap[$errCode];
    }

    /**
     * 获取文件扩展名
     * @return string
     */
    private function getFileExt()
    {
        return strtolower(strrchr($this->oriName, '.'));
    }

    /**
     * 重命名文件
     * @return string
     */
    private function getFullName()
    {
        //替换日期事件
        $t = time();
        $d = explode('-', date("Y-y-m-d-H-i-s"));
        $format = $this->config["pathFormat"];
        $format = str_replace("{yyyy}", $d[0], $format);
        $format = str_replace("{yy}", $d[1], $format);
        $format = str_replace("{mm}", $d[2], $format);
        $format = str_replace("{dd}", $d[3], $format);
        $format = str_replace("{hh}", $d[4], $format);
        $format = str_replace("{ii}", $d[5], $format);
        $format = str_replace("{ss}", $d[6], $format);
        $format = str_replace("{time}", $t, $format);

        //过滤文件名的非法自负,并替换文件名
        $oriName = substr($this->oriName, 0, strrpos($this->oriName, '.'));
        $oriName = preg_replace("/[\|\?\"\<\>\/\*\\\\]+/", '', $oriName);
        $format = str_replace("{filename}", $oriName, $format);

        //替换随机字符串
        $randNum = rand(1, 10000000000) . rand(1, 10000000000);
        if (preg_match("/\{rand\:([\d]*)\}/i", $format, $matches)) {
            $format = preg_replace("/\{rand\:[\d]*\}/i", substr($randNum, 0, $matches[1]), $format);
        }

        $ext = $this->getFileExt();
        return $format . $ext;
    }

    /**
     * 获取文件名
     * @return string
     */
    private function getFileName () {
        return substr($this->filePath, strrpos($this->filePath, '/') + 1);
    }

    /**
     * 获取文件完整路径
     * @return string
     */
    private function getFilePath()
    {
        $fullname = $this->fullName;
        $rootPath = $_SERVER['DOCUMENT_ROOT'];

        if (substr($fullname, 0, 1) != '/') {
            $fullname = '/' . $fullname;
        }

        return $rootPath . $fullname;
    }

    /**
     * 文件类型检测
     * @return bool
     */
    private function checkType()
    {
        return in_array($this->getFileExt(), $this->config["allowFiles"]);
    }

    /**
     * 文件大小检测
     * @return bool
     */
    private function  checkSize()
    {
        return $this->fileSize <= ($this->config["maxSize"]);
    }

    /**
     * 获取当前上传成功文件的各项信息
     * @return array
     */
    public function getFileInfo()
    {
        return array(
            "state" => $this->stateInfo,
            "url" => $this->fullName,
            "title" => $this->fileName,
            "original" => $this->oriName,
            "type" => $this->fileType,
            "size" => $this->fileSize
        );
    }

}
// class UploadsHandler
// {
//     /** 
//      * @var UploadedFile $file; 
//      */
//     protected $file; 
//     /** 
//      * 上传错误信息 
//      * @var string 
//      */
//     private $error = ''; //上传错误信息 
//     private $fullPath='';//绝对地址 
//     private $config = array( 
//       'maxSize'    => 0, //上传的文件大小限制 (0-不做限制) 
//       'exts'     => array('jpg','jpeg','gif','png','doc','docx','xls','xlsx','ppt','pptx','pdf','rar','zip'), //允许上传的文件后缀 
//       'subName'    => '', //子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组 
//       'rootPath'   => '/uploads', //保存根路径 
//       'savePath'   => '', //保存路径 
//       'thumb'     => array(),//是裁剪压缩比例 
//     ); 
//     public function __construct($config = array()){ 
//       /* 获取配置 */
//       $this->config  =  array_merge($this->config, $config); 
//       if(!empty($this->config['exts'])){ 
//         if (is_string($this->exts)){ 
//           $this->config['exts'] = explode(',', $this->exts); 
//         } 
//         $this->config['exts'] = array_map('strtolower', $this->exts); 
//       } 
//       $this->config['subName'] = $this->subName ? ltrim($this->subName,'/') : '/'.date('Ym').'/'.date("d"); 
//       $this->fullPath = rtrim(public_path(),'/').$this->config['rootPath']; 
//     } 
//     public function __get($name) { 
//       return $this->config[$name]; 
//     } 
//     public function __set($name,$value){ 
//       if(isset($this->config[$name])) { 
//         $this->config[$name] = $value; 
//       } 
//     } 
//     public function __isset($name){ 
//       return isset($this->config[$name]); 
//     } 
//     /** 
//      * 获取最后一次上传错误信息 
//      * @return string 错误信息 
//      */
//     public function getError(){ 
//       return $this->error; 
//     } 
//     public function upload($file){ 
//        if(empty($file)){ 
//          $this->error = '没有上传的文件'; 
//          return false; 
//        } 
//        if(!$this->checkRootPath($this->fullPath)){ 
//          $this->error = $this->getError(); 
//          return false; 
//        } 
//        $fileSavePath=$this->fullPath.$this->savePath.$this->subName; 
//        if(!$this->checkSavePath($fileSavePath)){ 
//          $this->error = $this->getError(); 
//          return false; 
//        } 
//        $files =array(); 
//        if(!is_array($file)){ 
//          //如果不是数组转成数组 
//          $files[]=$file; 
//        }else{ 
//          $files=$file; 
//        } 
//       $info  = array(); 
//        // $imgThumb = new \App\ThinkClass\ThumbClass(); 
//        foreach ($files as $key=>$f){ 
//          $this->file=$f; 
//           $f->ext = strtolower($f->getClientOriginalExtension()); 
//          /*文件上传检查*/
//          if (!$this->check($f)){ 
//            continue; 
//          } 
//          $fileName = str_random(12).'.'.$f->ext; 
//          /* 保存文件 并记录保存成功的文件 */
//          if ($this->file->move($fileSavePath,$fileName)) { 
//            /*图片按照宽高比例压缩*/
//            \Log::notice($fileSavePath.$fileName); 
//            if(!empty($this->thumb) && is_array($this->thumb)){ 
//              // $imgThumb ->thumb($this->thumb,$fileSavePath.'/'.$fileName); 
//            } 
//            $info[]=$this->rootPath.$this->savePath.$this->subName.'/'.$fileName; 
//          } 
//        } 
//        return is_array($info) ? $info : false; 
//     } 
//     /** 
//      * 检测上传根目录 
//      * @param string $rootpath  根目录 
//      * @return boolean true-检测通过，false-检测失败 
//      */
//     protected function checkRootPath($rootpath){ 
//       if(!(is_dir($rootpath) && is_writable($rootpath))){ 
//         $this->error = '上传根目录不存在！'; 
//         return false; 
//       } 
//       return true; 
//     } 
//     /** 
//      * 检测上传目录 
//      * @param string $savepath 上传目录 
//      * @return boolean     检测结果，true-通过，false-失败 
//      */
//     public function checkSavePath($savepath){ 
//       /* 检测并创建目录 */
//       if (!$this->mkdir($savepath )) { 
//         return false; 
//       } else { 
//         /* 检测目录是否可写 */
//         if (!is_writable($savepath)) { 
//           $this->error = '上传目录不可写！'; 
//           return false; 
//         } else { 
//           return true; 
//         } 
//       } 
//     } 
//     /** 
//      * 检查上传的文件 
//      * @param array $file 文件信息 
//      */
//     private function check($file) { 
//       /* 检查文件大小 */
//       if (!$this->checkSize($file->getSize())) { 
//         $this->error = '上传文件大小不符！'; 
//         return false; 
//       } 
//       /* 检查文件后缀 */
//       if (!$this->checkExt($file->ext)) { 
//         $this->error = '上传文件后缀不允许'; 
//         return false; 
//       } 
//       /* 通过检测 */
//       return true; 
//     } 
//     /** 
//      * 检查文件大小是否合法 
//      * @param integer $size 数据 
//      */
//     private function checkSize($size) { 
//       return !($size > $this->maxSize) || (0 == $this->maxSize); 
//     } 
//     /** 
//      * 检查上传的文件后缀是否合法 
//      * @param string $ext 后缀 
//      */
//     private function checkExt($ext) { 
//       return empty($this->config['exts']) ? true : in_array(strtolower($ext), $this->exts); 
//     } 
//     /** 
//      * 创建目录 
//      * @param string $savepath 要创建的穆里 
//      * @return boolean     创建状态，true-成功，false-失败 
//      */
//     protected function mkdir($savepath){ 
//         if(is_dir($savepath)){ 
//           return true; 
//         } 
//         if(mkdir($savepath, 0777, true)){ 
//           return true; 
//         } else { 
//           $this->error = "目录创建失败"; 
//           return false; 
//         } 
//     } 

//     //图片加密
//     public function Base_en($file_name = '' , $file_dir = '' , $status = '')
//     {
//       // base64_decode(data);
//     }
//     //图片解密
//     public function Base_de($file_name = '' , $file_dir = '' , $status = '')
//     {

//       // base64_decode(data);
//     }



// }
