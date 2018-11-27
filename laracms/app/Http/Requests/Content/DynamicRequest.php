<?php

namespace App\Http\Requests\Content;

use Illuminate\Validation\Rule;
use App\Http\Requests\Request;
class DynamicRequest extends Request
{
    public function rules()
    {

        return [
            'dynamic_title' => 'required|max:60',
            'dynamic_content' => 'required|max:95555',
            'dynamic_release_time' => 'required|date',
            'dynamic_img_path' => 'mimes:jpeg,bmp,png,gif',
            'dynamic_link' => 'required|min:2',
        ];
    }

    public function messages()
    {
        return [
            'dynamic_title.required' => '标题不能为空',
            'dynamic_release_time.required' => '发布时间不能为空',
            'dynamic_title.max' => '名称不能超过60个字符',
            'dynamic_content.required' => '描述不能为空',
            'dynamic_content.max' => '介绍不能超过95555字符',
            'dynamic_release_time.date' => '发布时间格式错误',
            'dynamic_img_path.mimes' => '文件只支持jpeg,bmp,png,gif格式',
            'dynamic_link.min' => '链接不能少于2个字符',
            'dynamic_link.required' => '新闻链接不能为空',
        ];
    }
}