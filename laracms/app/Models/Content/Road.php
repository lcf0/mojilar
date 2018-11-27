<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
//墨迹之路
class Road extends Model
{
    //选择数据库
    protected $connection = 'mojisql';
    //选择表
    protected $table = 'road_list';
    //数据字段
    protected $fillable = [ 'road_id',
                            'road_name', 
                            'road_operate_user', 
                            'road_img_path', 
                            'road_content', 
                            'road_release_time', 
                            'road_create_time',
                            'road_update_time', 
                            'road_ishow' 
                        ];
    //不定义时间
    public $timestamps = false;
    //自定义主键ID默认'id'
    protected $primaryKey = 'road_id';
}
