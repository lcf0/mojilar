<?php
namespace App\Http\Requests\Content;

use Illuminate\Validation\Rule;
use App\Http\Requests\Request;
class BcontactRequest extends Request
{
    public function rules()
    {

        return [
            'contact_name' => 'required|max:255',
            'contact_people'=>'required|max:40',
            'contact_release_time' => 'required|date',
            'contact_tel'=> 'required|numeric',
            'contact_qq'=> 'required|numeric',
            'contact_email'=>'required|email'
        ];
    }

    public function messages()
    {
        return [
            'contact_email.required'=>' 邮箱不能为空',
            'contact_email.email'=>' 邮箱格式有误请重新输入',
            'contact_qq.numeric'=>'QQ号码必须为数字',
            'contact_tel.required'=>'联系电话不能为空',
            'contact_tel.numeric'=>'联系电话格式错误',
            // 'contact_tel.max'=>'联系电话不能超过15个字符',
            'contact_people.required' => '联系人不能为空',
            'contact_people.max' => '联系人不能超过40字符',
            'contact_name.required' => '标题不能为空',
            'contact_release_time.required' => '发布时间不能为空',
            'contact_name.max' => '名称不能超过255个字符',
            'contact_release_time.date' => '发布时间格式错误',
        ];
    }
}