<?php
namespace App\Http\Requests\Content;

use Illuminate\Validation\Rule;
use App\Http\Requests\Request;
class ProtocolRequest extends Request
{
    public function rules()
    {

        return [
            'protocol_titile' => 'required|max:100',
            'protocol_content' => 'required|max:95555',//最大可储存4G：限制95555
            'protocol_release_time' => 'required|date',
        ];  
    }

    public function messages()
    {
        return [
            'protocol_titile.required' => '协议标题不能为空',
            'protocol_titile.max' => '协议标题不能超过100个字符',
            'protocol_content.required' => '协议内容不能为空',
            'protocol_content.max' => '协议内容不能超过95555',
            'protocol_release_time.required' => '发布时间不能为空',
            'protocol_release_time.date' => '发布时间格式错误',
        ];
    }
}