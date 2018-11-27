<?php
/**
 * 墨迹天气 - CMS based on laravel
 *
 * @category  墨迹天气
 * @package   Laravel
 * @author    chaofei.li@moji.com
 * @copyright Copyright 2018 墨迹天气
 * @version   Release 1.0
 */

namespace App\Http\Controllers\Content;

use App\Models\Content\Video;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\Content\VideoRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;

/**
 * 页面控制器
 *
 * Class VideoController
 * @package App\Http\Controllers\Administrator
 */
class VideoController extends Controller
{
    public function __construct(Request $request)
    {
        static::$activeNavId = 'content.video';
    }
    
    /**
     * 列表
     *
     * @param page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Video $video ,Request $request)
    {
       
        if (!empty($serach = $request->get('video_name'))) {
            $lists = Video::where('video_name', 'like', '%'.$serach.'%')->paginate(config('administrator.paginate.limit'));
        }else{
            $serach = '';
            $lists = Video::paginate(config('administrator.paginate.limit'));
        }
        $this->authorize('index', $video);
        // echo "string";die;
        // $lists =  $video->filterWith()->ordered()->recent()->paginate(config('administrator.paginate.limit'));
        
        return backend_view('video.list')->with(['lists'=>$lists,'serach'=>$serach]);
    }

    /**
     * 详情
     *
     * @param page $page
     * @return mixed
     */
    public function show(Video $video)
    {
        $lists = Video::all();
         return backend_view('video.list')->with('lists' , $lists);
    }

    /**
     * 创建
     *
     * @param page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Video $video)
    {
        $this->authorize('create', $video);

        return backend_view('video.create', compact('video'));
    }

    /**
     * 保存
     *
     * @param pageRequest $request
     * @param page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
    //  */
    public function store( VideoRequest $request,Video $video)
    {
        
        $this->authorize('create', $video);
        $up   = array('video_ogg','video_webm','video_mp4','video_mov','video_cover');
        $data = $this->upload($request , $up);

        $insert = array();
        $insert                       =  $request->only('video_name','video_release_time');
        $insert['video_create_time']  = date("Y-m-d H:i:s",time());
        $insert['video_update_time']  = date("Y-m-d H:i:s",time());
        $insert['video_operate_user'] = Auth::user()->name;
        $insert = array_merge($data , $insert);
        $video = Video::create($insert);
        return $this->redirect('video.list')->with('success', '添加成功.');
    }

    /**
     * 编辑
     *
     * @param page $page
     * @return mixed
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Video $video)
    {
        $img_path = config('administrator.img_path');
        $this->authorize('update', $video);
        return backend_view('video.create', compact('video'))->with('img_path',$img_path);
    }

    /**
     * 更新
     *
     * @param pageRequest $request
     * @param page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(VideoRequest $request, Video $video)
    {
        $up   = array('video_ogg','video_webm','video_mp4','video_mov','video_cover');
        $data = $this->upload($request , $up , false);
        $update = array();
        $update                       =  $request->only('video_name','video_release_time');
        $update['video_create_time']  = date("Y-m-d H:i:s",time());
        $update['video_update_time']  = date("Y-m-d H:i:s",time());
        $update['video_operate_user'] = Auth::user()->name;
        if ($data) $update = array_merge($data , $update);       

        $this->authorize('update', $video);

        $video->update($update);

        return $this->redirect('video.list')->with('success', '更新成功.');
    }

    /**
     * 删除
     *
     * @param page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Video $video)
    {
        $this->authorize('destroy', $video);
        $video->delete();

        return $this->redirect()->with('success', '删除成功.');
    }

    public function upload($request = '' , $up , $status = 1){
        if ($status) {
            for ($i=0; $i <count($up) ; $i++) { 
                $file[$up[$i]] = $request->file($up[$i]);
                if (!($file[$up[$i]]->isValid()))return $this->redirect('video.list')->with('message', $up[$i].'上传为空.');
            }
        }else{
            for ($i=0; $i <count($up) ; $i++) { 
                if (null!==$request->file($up[$i])) {
                    $file[$up[$i]] = $request->file($up[$i]);
                    if (!($file[$up[$i]]->isValid()))return $this->redirect('video.list')->with('message', $up[$i].'上传失败.');
                }
                
            }
        }
        $mem = array();
        $return = false;
        if (!empty($file)) {
                foreach ($file as $key => $value) {
                    $file_name = strtolower(md5(time().rand(1000,99999)).'_'.Auth::user()->email);

                    //获取文件的扩展名 
                    $ext = $value->getClientOriginalExtension();

                    //获取文件的绝对路径
                    $path = $value->getRealPath();
                    // echo $path;die;
                    //定义文件名
                    $filename = date("Ym").'/'.date('d').'/'.$file_name.'.'.$ext;
                    $mem[] = &$filename ;

                    //如果有文件上传失败，将已上传文件清除
                    if(!(Storage::disk('local')->put($filename, file_get_contents($path)))){
                        for ($i=0; $i <count($mem) ; $i++) { 
                            $delname = date("Ym").'/'.date('d').'/'.$mem[$i];
                            Storage::delete($delname);
                        }
                        return $this->redirect()->with('message', '文件上传出错！');
                    }

                    $return[$key] = 'uploads/'.$filename;
                }
        }        
        return $return;

    }
}