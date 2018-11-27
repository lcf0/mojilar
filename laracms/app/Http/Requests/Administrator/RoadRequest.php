<?php


namespace App\Http\Requests\Administrator;

use Illuminate\Validation\Rule;

class RoadRequest extends Request
{
    public function rules()
    {

        return [
            'road_ishow' => 'required|min:1|max:2',
            'road_name' => 'required|max:60',
            'road_content' => 'required|max:95555',
            'road_release_time' => 'required|date',
            'road_img_path' => 'mimes:jpeg,bmp,png,gif',
        ];
    }

    public function messages()
    {
        return [
            'road_name.required' => '类型不能为空',
            'road_release_time.required' => '发布时间不能为空',
            'road_name.max' => '名称不能超过60个字符',
            'road_content.required' => '描述不能为空',
            'road_content.max' => '介绍不能超过2000字符',
            'road_release_time.date' => '发布时间格式错误',
            'road_img_path.mimes' => '文件只支持jpeg,bmp,png,gif格式',
        ];
    }
}