<?php
namespace App\Http\Requests\Content;

use Illuminate\Validation\Rule;
use App\Http\Requests\Request;
class BrandRequest extends Request
{
    public function rules()
    {

        return [
            'brand_name' => 'required|max:60',
            'brand_content' => 'required|max:95555',
            'brand_release_time' => 'required|date',
            'brand_ishow' => 'required',
            'brand_img1' => 'required|mimes:jpeg,bmp,png,gif',
            'brand_img2' => 'required|mimes:jpeg,bmp,png,gif',
            'brand_img3' => 'required|mimes:jpeg,bmp,png,gif',
            'brand_img4' => 'mimes:jpeg,bmp,png,gif',
            'brand_img5' => 'mimes:jpeg,bmp,png,gif',
            'brand_img6' => 'mimes:jpeg,bmp,png,gif',
        ];
    }

    public function messages()
    {
        return [
            'brand_name.required' => '标题不能为空',
            'brand_release_time.required' => '发布时间不能为空',
            'brand_name.max' => '名称不能超过60个字符',
            'brand_content.required' => '描述不能为空',
            'brand_content.max' => '介绍不能超过95555字符',
            'brand_release_time.date' => '发布时间格式错误',
            'brand_img1.mimes' => '文件只支持jpeg,bmp,png,gif格式（图片1）',
            'brand_img2.mimes' => '文件只支持jpeg,bmp,png,gif格式（图片2）',
            'brand_img3.mimes' => '文件只支持jpeg,bmp,png,gif格式（图片3）',
            'brand_img4.mimes' => '文件只支持jpeg,bmp,png,gif格式（图片4）',
            'brand_img5.mimes' => '文件只支持jpeg,bmp,png,gif格式（图片5）',
            'brand_img6.mimes' => '文件只支持jpeg,bmp,png,gif格式（图片6）',
            'brand_img1.required' => '最少上传三张图片（图片1）',
            'brand_img2.required' => '最少上传三张图片（图片2）',
            'brand_img3.required' => '最少上传三张图片（图片3）',
        ];
    }
}