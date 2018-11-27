<?php
namespace App\Http\Requests\Content;

use Illuminate\Validation\Rule;
use App\Http\Requests\Request;
class InfoRequest extends Request
{
    public function rules()
    {

        return [
            'info_title'        => 'required|max:100',
            'info_focus'         => 'required|max:65535',
            'info_content'       => 'required|max:95555',
            'info_link'         => 'required|max:1000',
            'info_release_time' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'info_title.required' => '资讯标题不能为空',           
            'info_title.max' => '资讯标题不能超过100个字符',
            'info_content.max' => '咨询内容不能超过95555个字符',
            'info_focus.required' => '咨询概要不能为空',           
            'info_focus.max' => '咨询概要不能超过65535个字符',
            'info_link.required' => '跳转连接不能为空',           
            'info_link.max' => '跳转连接不能超过255个字符',
            'info_content.required' => '咨询内容不能为空',
            'info_release_time.required' => '发布时间不能为空',
            'info_release_time.date' => '发布时间格式错误',
        ];
    }
}