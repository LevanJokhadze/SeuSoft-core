<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreultraServiceRequest extends FormRequest
{
    public function authorize()
    {
        return false;
    }

    public function rules()
    {
        return [
            'titles' => 'required',
            'images' => 'required',
        ];
    }
}
