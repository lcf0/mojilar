<?php
namespace App\Http\Requests\Content;

use Illuminate\Validation\Rule;
use App\Http\Requests\Request;
class IssueRequest extends Request
{
    public function rules()
    {

        return [
            'issue_type'         => 'required|max:40',
            'issue_terrace_name' => 'required|max:40',
            'issue_num'          => 'required|max:199',
            'issue_link'         => 'required|max:1000',
            'issue_release_time' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'issue_type.required' => '版本类型不能为空',           
            'issue_type.max' => '版本类型不能超过40个字符',
            'issue_terrace_name.max' => '平台名称不能超过40个字符',
            'issue_num.required' => '版本号不能为空',           
            'issue_num.max' => '版本号不能超过200个字符',
            'issue_link.required' => '下载地址不能为空',           
            'issue_link.max' => '下载地址不能超过1000个字符',
            'issue_terrace_name.required' => '平台名称不能为空',
            'issue_release_time.required' => '发布时间不能为空',
            'issue_release_time.date' => '发布时间格式错误',
        ];
    }
}