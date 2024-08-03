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
            'titleEn' => 'sometimes|string',
            'titleGe' => 'sometimes|string',
            'titlesEn' => 'sometimes|json',
            'titlesGe' => 'sometimes|json',
            'href'=>'sometimes|json',
            'bodyEn' => 'nullable|string',
            'bodyGe' => 'nullable|string',
            'images' => 'sometimes|json',
        ];
    }
}
