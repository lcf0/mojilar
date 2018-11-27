<?php
namespace App\Http\Requests\Content;

use Illuminate\Validation\Rule;
use App\Http\Requests\Request;
class ProblemRequest extends Request
{
    public function rules()
    {

        return [
            'problem_type' => 'required|max:40',
            'problem_ask' => 'required|max:65535',//text类型最大储存长度65535
            'problem_release_time' => 'required|date',
            'problem_answer' => 'required|max:65535',//text类型最大储存长度65535
        ];
    }

    public function messages()
    {
        return [
            'problem_type.required' => '平台类型不能为空',
            'problem_release_time.required' => '发布时间不能为空',
            'problem_type.max' => '名称不能超过40个字符',
            'problem_ask.required' => '问题不能为空',
            'problem_ask.max' => '问题不能超过65535字符',
            'problem_answer.required' => '答案不能为空',
            'problem_answer.max' => '答案不能超过65535字符',
            'problem_release_time.date' => '发布时间格式错误',
        ];
    }
}