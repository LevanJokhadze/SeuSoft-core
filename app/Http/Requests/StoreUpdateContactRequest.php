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
            'title' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'number' => 'required|string|max:20',
            'fb' => 'nullable|string|max:255',
            'ig' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'in' => 'nullable|string|max:255',
            'copyright' => 'required|string|max:255',
        ];
    }
}
