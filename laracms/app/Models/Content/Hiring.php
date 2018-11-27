<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\WithCommonHelper;
use App\Events\BehaviorLogEvent;
use Illuminate\Database\Eloquent\SoftDeletes;
//招聘
class Hiring extends Model
{
    //选择数据库
    protected $connection = 'mojisql';
    //选择表
    protected $table = 'hiring_list';
    //数据字段
    protected $fillable = [ 'hiring_id',
                            'hiring_name', 
                            'hiring_operate_user', 
                            'hiring_img', 
                            'hiring_content', 
                            'hiring_release_time',
                            'hiring_create_time', 
                            'hiring_update_time',
                            'hiring_ishow' 
                        ];
    //不定义时间
    public $timestamps = false;
    //自定义主键ID默认'id'
    protected $primaryKey = 'hiring_id';

    public function titleName(){
        return 'hiring_name';
    }

    public function created_user(){
        return $this->belongsTo('App\Models\User', 'created_op');
    }

    public function updated_user(){
        return $this->belongsTo('App\Models\User', 'updated_op');
    }

    public function filterWith(){
        return $this->where('type','page')->with(['hiring_name']);
    }
}
