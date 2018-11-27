<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
//升级日志
class Protocol extends Model
{
    //选择数据库
    protected $connection = 'mojisql';
    //选择表
    protected $table = 'protocol_list';
    //数据字段
    protected $fillable = [ 'protocol_id',
                            'protocol_titile',
                            'protocol_content',
                            'protocol_operate_user', 
                            'protocol_release_time', 
                            'protocol_create_time',
                            'protocol_update_time', 
                        ];
    //不定义时间
    public $timestamps = false;
    //自定义主键ID默认'id'
    protected $primaryKey = 'protocol_id';
}
