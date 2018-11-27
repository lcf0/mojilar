<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
//发版管理
class Info extends Model
{
    //选择数据库
    protected $connection = 'mojisql';
    //选择表
    protected $table = 'info_list';
    //数据字段
    protected $fillable = [ 'info_id',
                            'info_title',
                            'info_focus', 
                            'info_content',
                            'info_link',
                            'info_operate_user', 
                            'info_release_time', 
                            'info_create_time',
                            'info_update_time', 
                        ];
    //不定义时间
    public $timestamps = false;
    //自定义主键ID默认'id'
    protected $primaryKey = 'info_id';
}
