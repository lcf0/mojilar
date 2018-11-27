<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
//升级日志
class Problem extends Model
{
    //选择数据库
    protected $connection = 'mojisql';
    //选择表
    protected $table = 'problem_list';
    //数据字段
    protected $fillable = [ 'problem_id',
                            'problem_type',
                            'problem_ask',
                            'problem_answer', 
                            'problem_operate_user', 
                            'problem_release_time', 
                            'problem_create_time',
                            'problem_update_time', 
                        ];
    //不定义时间
    public $timestamps = false;
    //自定义主键ID默认'id'
    protected $primaryKey = 'problem_id';
}
