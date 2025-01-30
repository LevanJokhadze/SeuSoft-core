<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateContactRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "name"=> "required|string|max:255",
            'titleEn' => 'required|string|max:255',
            'titleGe' => 'required|string|max:255',
            'addressEn' => 'required|string|max:255',
            'addressGe' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'number' => 'required|string|max:40',
            'fb' => 'nullable|string|max:255',
            'ig' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'in' => 'nullable|string|max:255',
            'copyright' => 'required|string|max:255',
        ];
    }
}
