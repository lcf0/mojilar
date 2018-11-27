<?php
namespace App\Http\Requests\Content;

use Illuminate\Validation\Rule;
use App\Http\Requests\Request;
class HiringRequest extends Request
{
    public function rules()
    {

        return [
            'hiring_name' => 'required|max:60',
            'hiring_content' => 'required|max:95555',
            'hiring_release_time' => 'required|date',
            'hiring_ishow' => 'required|boolean',
            'hiring_img' => 'mimes:jpeg,bmp,png,gif',
        ];
    }

    public function messages()
    {
        return [
            'hiring_name.required' => '标题不能为空',
            'hiring_release_time.required' => '发布时间不能为空',
            'hiring_name.max' => '名称不能超过60个字符',
            'hiring_content.required' => '描述不能为空',
            'hiring_content.max' => '介绍不能超过95555字符',
            'hiring_release_time.date' => '发布时间格式错误',
            'hiring_img.mimes' => '文件只支持jpeg,bmp,png,gif格式',
            'hiring_ishow.required' => '请检查状态',
            'hiring_ishow.boolean' => '请检查状态数据格式',
        ];
    }
}