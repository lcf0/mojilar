<?php
namespace App\Http\Requests\Content;

use Illuminate\Validation\Rule;
use App\Http\Requests\Request;
class UplogRequest extends Request
{
    public function rules()
    {
        switch($this->method())
        {
            case 'POST':{
                return [
                    'uplog_title' => 'required|max:60',
                    'uplog_type' => 'required|max:40',
                    'uplog_down_link' => 'required|max:254',
                    'uplog_content' => 'required|max:95555',
                    'uplog_release_time' => 'required|date',
                    'uplog_img' => 'required|mimes:jpeg,bmp,png,gif',
                ];
            }
            case 'PATCH':{
                return [
                    'uplog_title' => 'required|max:60',
                    'uplog_type' => 'required|max:40',
                    'uplog_down_link' => 'required|max:254',
                    'uplog_content' => 'required|max:95555',
                    'uplog_release_time' => 'required|date',
                    'uplog_img' => 'mimes:jpeg,bmp,png,gif',
                ];
            }
                
        }
        
    }

    public function messages()
    {
        return [
            'uplog_title.required' => '标题不能为空',
            'uplog_release_time.required' => '发布时间不能为空',
            'uplog_title.max' => '名称不能超过60个字符',
            'uplog_content.required' => '描述不能为空',
            'uplog_content.max' => '介绍不能超过95555字符',
            'uplog_release_time.date' => '发布时间格式错误',
            'uplog_img.mimes' => '文件只支持jpeg,bmp,png,gif格式',
            'uplog_img.required' => '请上传图片',
            'uplog_down_link.required' => '下载地址不得为空',
            'uplog_down_link.max' => '下载地址不得超过255字符',
            'uplog_type.required' => '平台类型不能为空',
            'uplog_type.max' => '平台类型不能超过40字符',
        ];
    }
}