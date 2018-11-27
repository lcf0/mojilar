<?php
/**
 * LaraCMS - CMS based on laravel
 *
 * @category  LaraCMS
 * @package   Laravel
 * @author    Wanglelecc <wanglelecc@gmail.com>
 * @date      2018/06/06 09:08:00
 * @copyright Copyright 2018 LaraCMS
 * @license   https://opensource.org/licenses/MIT
 * @github    https://github.com/wanglelecc/laracms
 * @link      https://www.laracms.cn
 * @version   Release 1.0
 */

namespace App\Http\Requests\Administrator;

use Illuminate\Validation\Rule;

class LinkRequest extends Request
{
    public function rules()
    {
        return [
            'name' => 'required|max:100',
            'rating' => 'nullable|integer|max:255',
            'order' => 'nullable|integer',
            'rel' => 'nullable|max:255',
            'description' => 'nullable|max:191',
            'status' => 'nullable|'.Rule::in(['0','1']),
            'image' => 'nullable|mimes:jpeg,bmp,png,gif',
            'release_time' => 'required|date',
        ];

    }

    public function messages()
    {
        return [
            'image.mimes' => '文件只支持jpeg,bmp,png,gif格式',
            'release_time.required' => '发布时间不能为空',
            'release_time.date' => '发布时间格式错误',
        ];
    }
}
