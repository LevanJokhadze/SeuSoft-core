<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorecontactRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'number' => 'string|min:8|max:15',
            'service' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'message' => 'required|string|max:545'
        ];
    }
}
