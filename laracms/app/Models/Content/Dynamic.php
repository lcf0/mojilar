<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\WithCommonHelper;
use App\Events\BehaviorLogEvent;
use Illuminate\Database\Eloquent\SoftDeletes;
//墨迹动态
class Dynamic extends Model
{
    //选择数据库
    protected $connection = 'mojisql';
    //选择表
    protected $table = 'dynamic_list';
    //数据字段
    protected $fillable = [ 'dynamic_id',
                            'dynamic_title', 
                            'dynamic_operate_user', 
                            'dynamic_img_path', 
                            'dynamic_content', 
                            'dynamic_link', 
                            'dynamic_release_time',
                            'dynamic_create_time', 
                            'dynamic_update_time',
                            'dynamic_ishow' 
                        ];
    //不定义时间
    public $timestamps = false;
    //自定义主键ID默认'id'
    protected $primaryKey = 'dynamic_id';

    public function titleName(){
        return 'dynamic_title';
    }

    public function created_user(){
        return $this->belongsTo('App\Models\User', 'created_op');
    }

    public function updated_user(){
        return $this->belongsTo('App\Models\User', 'updated_op');
    }

    public function filterWith(){
        return $this->where('type','page')->with(['dynamic_title']);
    }
}
