<?php
namespace App\Http\Requests\Content;

use Illuminate\Validation\Rule;
use App\Http\Requests\Request;
class ImgRequest extends Request
{
    public function rules()
    {
        switch($this->method())
        {
            case 'POST':{
                return [
                    'img_type' => 'required|max:40',
                    'img_release_time' => 'required|date',
                    'img_path' => 'required|mimes:jpeg,bmp,png,gif',
                ];
            }
            case 'PATCH':{
                return [
                    'img_type' => 'required|max:40',
                    'img_release_time' => 'required|date',
                    'img_path' => 'mimes:jpeg,bmp,png,gif',
                ];
            }
                
        }
        
    }

    public function messages()
    {
        return [
            'img_release_time.required' => '发布时间不能为空',
            'img_type.required' => '图片类型不能为空',
            'img_type.max' => '图片类型不能超过40字符',
            'img_release_time.date' => '发布时间格式错误',
            'img_path.mimes' => '文件只支持jpeg,bmp,png,gif格式',
            'img_path.required' => '请上传图片',
        ];
    }
}