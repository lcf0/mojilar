<?php

namespace App\Http\Requests\Administrator;

use Illuminate\Validation\Rule;

class AboutRequest extends Request
{
    public function rules()
    {

        return [
            'about_type' => 'required|max:200',
            'about_title' => 'required|max:60',
            'about_content' => 'required|max:95555',
            'about_release_time' => 'required|date',
            'about_img_path' => 'mimes:jpeg,bmp,png,gif',
        ];
    }

    public function messages()
    {
        return [
            'about_title.required' => '类型不能为空',
            'about_release_time.required' => '发布时间不能为空',
            'about_title.max' => '名称不能超过255个字符',
            'about_content.required' => '描述不能为空',
            'about_content.max' => '介绍不能超过2000字符',
            'about_release_time.date' => '发布时间格式错误',
            'about_img_path.mimes' => '文件只支持jpeg,bmp,png,gif格式',
        ];
    }
}