<?php
namespace App\Http\Requests\Content;

use Illuminate\Validation\Rule;
use App\Http\Requests\Request;
class BnameRequest extends Request
{
    public function rules()
    {

        return [
            'bname_name' => 'required|max:255',
            'bname_content' => 'required|max:1000',
            'bname_release_time' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'bname_name.required' => '标题不能为空',
            'bname_release_time.required' => '发布时间不能为空',
            'bname_name.max' => '名称不能超过255个字符',
            'bname_content.required' => '描述不能为空',
            'bname_content.max' => '介绍不能超过1000字符',
            'bname_release_time.date' => '发布时间格式错误',
        ];
    }
}