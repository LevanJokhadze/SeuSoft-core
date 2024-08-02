<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string',
            'body' => 'nullable|string',
            'titles' => 'sometimes|json',
            'images' => 'sometimes|json',
        ];
    }
}
