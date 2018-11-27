<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
//升级日志
class Uplog extends Model
{
    //选择数据库
    protected $connection = 'mojisql';
    //选择表
    protected $table = 'uplog_list';
    //数据字段
    protected $fillable = [ 'uplog_id',
                            'uplog_title',
                            'uplog_type',
                            'uplog_content', 
                            'uplog_img',
                            'uplog_down_link',
                            'uplog_operate_user', 
                            'uplog_release_time', 
                            'uplog_create_time',
                            'uplog_update_time', 
                        ];
    //不定义时间
    public $timestamps = false;
    //自定义主键ID默认'id'
    protected $primaryKey = 'uplog_id';
}
