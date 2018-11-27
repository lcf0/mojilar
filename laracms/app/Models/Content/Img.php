<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
//发版管理
class Img extends Model
{
    //选择数据库
    protected $connection = 'mojisql';
    //选择表
    protected $table = 'img_list';
    //数据字段
    protected $fillable = [ 'img_id',
                            'img_type',
                            'img_path', 
                            'img_operate_user', 
                            'img_release_time', 
                            'img_create_time',
                            'img_update_time', 
                        ];
    //不定义时间
    public $timestamps = false;
    //自定义主键ID默认'id'
    protected $primaryKey = 'img_id';
}
