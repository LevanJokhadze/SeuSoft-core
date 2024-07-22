<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUpdateContactRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
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
