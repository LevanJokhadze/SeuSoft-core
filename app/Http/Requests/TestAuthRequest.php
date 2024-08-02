<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestAuthRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
            'recaptcha_token' => 'required',
        ];
    }
}
