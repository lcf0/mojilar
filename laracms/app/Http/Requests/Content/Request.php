<?php

namespace App\Http\Requests\Conetnt;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

}