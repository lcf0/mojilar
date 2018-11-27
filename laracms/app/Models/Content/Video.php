<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
//升级日志
class Video extends Model
{
    //选择数据库
    protected $connection = 'mojisql';
    //选择表
    protected $table = 'video_list';
    //数据字段
    protected $fillable = [ 'video_id',
                            'video_name',
                            'video_ogg',
                            'video_webm', 
                            'video_mp4',
                            'video_mov',
                            'video_cover',
                            'video_operate_user', 
                            'video_release_time', 
                            'video_create_time',
                            'video_update_time', 
                        ];
    //不定义时间
    public $timestamps = false;
    //自定义主键ID默认'id'
    protected $primaryKey = 'video_id';
}
