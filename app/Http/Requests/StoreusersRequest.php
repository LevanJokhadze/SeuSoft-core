<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreusersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Allow processing unless specific conditions are meant to block it
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            // Add other fields as necessary, e.g., 'password' => 'required|string|min:6'
        ];
    }
}
