<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
//商务合作类型
class Bname extends Model
{
    //选择数据库
    protected $connection = 'mojisql';
    //选择表
    protected $table = 'busine_name';
    //数据字段
    protected $fillable = [	'bname_id',
    						'bname_name', 
    						'bname_content', 
    						'bname_release_time', 
    						'bname_operate_user',
    						'bname_create_time', 
    						'bname_update_time' 
    					];
    //不定义时间
    public $timestamps = false;
    //自定义主键ID默认'id'
    protected $primaryKey = 'bname_id';
}
