<?php

namespace App\Handlers;

//define('LOG_PATH', '/opt/logs/coapi/');
define('LOG_PATH',  env('APP_LOG_PATH'));
define('LOG_LEVEL', 1);
//define('AUTOLOG_PATH', '/opt/logs/coapi/');
define('AUTOLOG_PATH',  env('APP_LOG_PATH'));
define('PROJECT', 'test');
define('HOSTNAME', gethostname());
define('TODAY',time());

class LarDebugHandler
{
    static public $_logPath;
    static public $_logCliPath;
    static public $_logLv = 1;
    static public $_runenv;

    /*
    static public function log($var)
    {
        //是否开启debug模式
        if(self::$_logLv > 0)
        {
            $debugInfo = debug_backtrace();
            //$filename = explode(DIRECTORY_SEPARATOR, $debugInfo[0]['file']);
            //$filename = end($filename);//get end element
            $lineNum = $debugInfo[0]['line'];
            $filename = $debugInfo[0]['file'];

            $time = TODAY;
            $timeH = date('H', $time);
            $timeHIS = date('H:i:s', $time);
            $timeYMD = date('Y-m-d', $time);
            if(self::$_runenv=="cli"){
                $todayDir = sprintf('%s%s/', self::$_logCliPath, $timeYMD);
            }else{
                $todayDir = sprintf('%s%s/', self::$_logPath, $timeYMD);
            }

            //print_r($todayDir);
            if(!file_exists($todayDir))
            {
                mkdir($todayDir,0777,true);
            }

            $logFile = sprintf('%s%s.log', $todayDir, $timeH);

            $msg = sprintf('%s-%s-%s:%s %s%s', $timeHIS, '[debug]', $filename, $lineNum, var_export($var, true), PHP_EOL);
            file_put_contents($logFile, $msg, FILE_APPEND);
        }
    }
    */

    /**日志写入
     *  var 日志内容 
     *  type 日志类型  1常规 2系统 3预警 4其他
     * 
     */
    static public function log($var,$type = 1,$level = 2)
    {
        //是否开启debug模式
        if(self::$_logLv > 0)
        {
            $debugInfo = debug_backtrace();
            //$filename = explode(DIRECTORY_SEPARATOR, $debugInfo[0]['file']);
            //$filename = end($filename);//get end element
            $lineNum = $debugInfo[0]['line'];
            $filename = $debugInfo[0]['file'];
            $logName = $filename.':'.$lineNum;  //位置 行号

            $time = TODAY;
            $timeHIS = date('Y-m-d H:i:s', $time);
            $timeYtdYMD = date('Y-m-d', $time-86400);
            
            $ytdFile = sprintf('%s%s.%s', LOG_PATH, self::dir($type), $timeYtdYMD);
            $logFile = sprintf('%s%s', LOG_PATH, self::dir($type));
            $level = sprintf('%s', self::level($level));

            if(!file_exists($ytdFile) && file_exists($logFile))
            {
                rename($logFile, $ytdFile);
            }
            $msg = sprintf('%s - %s - %s - %s - %s - %s%s', '[php]', $timeHIS, $level, HOSTNAME, $logName, var_export($var, true), PHP_EOL);
            
            file_put_contents($logFile, $msg, FILE_APPEND);

        }
    }

    /*host name
     * 不同的路径
     * type 根据不同类型返回不同的日志类型 默认常规日志
     * project 定义项目名称 默认值根据不同项目给
     * */
    static private function dir($type,$project = 'coapi')
    {
        switch($type){
            case 1://1常规
                $log = 'statistics_'.$project.'_web.log';
                break;
            case 2://2系统
                $log = 'system_'.$project.'_web.log';
                break;
            case 3://3预警
                $log = 'monitor_'.$project.'_web.log';
                break;
            case 4://4其他
                $log = 'other_'.$project.'_web.log';
                break;
            default:
                $log = 'statistics_'.$project.'_web.log';
                break;
        }
        return $log;
    }

    /*host name
     * 不同的日志级别 目前只设定debug可以根据参数设定
     * */
    static private function level($level)
    {
        switch($level){
            case 1://1常规
                $level = 'DEBUG ';
                break;
            case 2://2常规
                $level = 'INFO';
                break;
            case 3://3错误
                $level = 'ERROR';
                break;
            case 4://4警告
                $level = 'WARN';
                break;
            default:
                $level = 'DEBUG';
                break;
        }
        return $level;
    }

    /*
     * 页面dump
     * 输出不同的页面颜色
     * */
    static public function dump($var)
    {
        echo '<pre style="background-color:' . self::dumpColor() . ';">';
        var_dump($var);
        echo '</pre>';
    }

    /*
     * 不同的颜色
     * */
    static private function dumpColor()
    {
        $color = array(
            'blue', 'green', 'purple', 'yellow', 'glob', 'pink', 'palegoldenrod', 'palegreen',
            'yellowgreen', 'yellow', 'wheat', 'violet', 'tomato', 'steelblue', 'skyblue', 'sienna', 'seashell',
            'seagreen', 'sandybrown', 'peru', 'peachpuff', 'papayawhip', 'thistle', 'slategray'
        );
        $countColor = count($color) - 1;
        $rand = rand(0, $countColor);
        return $color[$rand];
    }
}