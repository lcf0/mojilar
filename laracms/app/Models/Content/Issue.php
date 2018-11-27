<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
//发版管理
class Issue extends Model
{
    //选择数据库
    protected $connection = 'mojisql';
    //选择表
    protected $table = 'issue_list';
    //数据字段
    protected $fillable = [ 'issue_id',
                            'issue_type',
                            'issue_terrace_name', 
                            'issue_num',
                            'issue_link',
                            'issue_operate_user', 
                            'issue_release_time', 
                            'issue_create_time',
                            'issue_update_time', 
                        ];
    //不定义时间
    public $timestamps = false;
    //自定义主键ID默认'id'
    protected $primaryKey = 'issue_id';
}
