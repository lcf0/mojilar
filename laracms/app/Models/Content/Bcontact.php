<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
//商务联系方式
class Bcontact extends Model
{
    //选择数据库
    protected $connection = 'mojisql';
    //选择表
    protected $table = 'busine_contact';
    //数据字段
    protected $fillable = [	'contact_id',
    						'contact_name', 
    						'contact_people', 
    						'contact_tel', 
                            'contact_qq',
    						'contact_email', 
    						'contact_release_time', 
    						'contact_operate_user',
    						'contact_create_time', 
    						'contact_update_time' 
    					];
    //不定义时间
    public $timestamps = false;
    //自定义主键ID默认'id'
    protected $primaryKey = 'contact_id';
}
