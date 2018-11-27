<?php
namespace App\Http\Requests\Content;

use Illuminate\Validation\Rule;
use App\Http\Requests\Request;
class VideoRequest extends Request
{
    public function rules()
    {
        switch($this->method())
        {
            case 'POST':{
                return [
                    // 'video_name' => 'required|max:100',
                    // 'video_ogg' => 'required|mimes:ogg',
                    // 'video_webm' => 'required|mimes:webm',
                    // 'video_mp4' => 'required|mimes:mp4',
                    // 'video_mov' => 'required|mimes:mov',
                    // 'video_cover' => 'required|mimes:jpeg,bmp,png,gif',
                    // 'video_release_time' => 'required|date',

                    'video_name' => 'required|max:100',
                    'video_ogg' => 'required|mimes:mp4',
                    'video_webm' => 'required|mimes:mp4',
                    'video_mp4' => 'required|mimes:mp4',
                    'video_mov' => 'required|mimes:mp4',
                    'video_cover' => 'required|mimes:jpeg,bmp,png,gif',
                    'video_release_time' => 'required|date',
                    
                ];
            }
            case 'PATCH':{
                return [
                    // 'video_name' => 'required|max:100',
                    // 'video_ogg' => 'mimes:ogg',
                    // 'video_webm' => 'mimes:webm',
                    // 'video_mp4' => 'mimes:mp4',
                    // 'video_mov' => 'mimes:mov',
                    // 'video_cover' => 'mimes:jpeg,bmp,png,gif',
                    // 'video_release_time' => 'required|date',


                    'video_name' => 'required|max:100',
                    'video_ogg' => 'mimes:mp4',
                    'video_webm' => 'mimes:mp4',
                    'video_mp4' => 'mimes:mp4',
                    'video_mov' => 'mimes:mp4',
                    'video_cover' => 'mimes:jpeg,bmp,png,gif',
                    'video_release_time' => 'required|date',
                ];
            }
                
        }
        
    }

    public function messages()
    {
        return [
            'video_name.required' => '视频名称不能为空',
            'video_release_time.required' => '发布时间不能为空',
            'video_name.max' => '视频名称不能超过100个字符',
            'video_ogg.required' => 'ogg格式视频不能为空',
            'video_ogg.mimes' => '必须上传ogg格式视频',
            'video_release_time.date' => '发布时间格式错误',
            'video_cover.mimes' => '文件只支持jpeg,bmp,png,gif格式',
            'video_cover.required' => '请上传图片',
            'video_webm.required' => 'webm格式视频不能为空',
            'video_webm.mimes' => '只支持webm格式视频',
            'video_mp4.required' => 'mp4格式视频不能为空',
            'video_mp4.mimes' => '只支持mp4格式视频',
            'video_mov.required' => 'mov格式视频不能为空',
            'video_mov.mimes' => '只支持mov格式视频',
        ];
    }
}