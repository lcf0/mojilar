<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\WithCommonHelper;
use App\Events\BehaviorLogEvent;
use Illuminate\Database\Eloquent\SoftDeletes;
//品牌案例
class Brand extends Model
{
    //选择数据库
    protected $connection = 'mojisql';
    //选择表
    protected $table = 'brand_list';
    //数据字段
    protected $fillable = [ 'brand_id',
                            'brand_name', 
                            'brand_type',
                            'brand_content',  
                            'brand_operate_user', 
                            'brand_img', 
                            'brand_online_time',
                            'brand_release_time',
                            'brand_create_time', 
                            'brand_update_time',
                            'brand_ishow' 
                        ];
    //不定义时间
    public $timestamps = false;
    //自定义主键ID默认'id'
    protected $primaryKey = 'brand_id';

    public function titleName(){
        return 'brand_name';
    }

    public function created_user(){
        return $this->belongsTo('App\Models\User', 'created_op');
    }

    public function updated_user(){
        return $this->belongsTo('App\Models\User', 'updated_op');
    }

    public function filterWith(){
        return $this->where('type','page')->with(['brand_name']);
    }
}
