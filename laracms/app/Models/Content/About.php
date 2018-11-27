<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
//关于墨迹
class About extends Model
{
    //选择数据库
    protected $connection = 'mojisql';
    //选择表
    protected $table = 'about_list';
    //数据字段
    protected $fillable = [	'about_id',
    						'about_title', 
    						'about_type', 
    						'about_img_path', 
    						'about_content', 
    						'about_release_time', 
    						'about_operate_user',
    						'about_create_time', 
    						'about_update_time' 
    					];
    //不定义时间
    public $timestamps = false;
    //自定义主键ID默认'id'
    protected $primaryKey = 'about_id';
}
