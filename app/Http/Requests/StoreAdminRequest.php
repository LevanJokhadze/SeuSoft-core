<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRequest extends FormRequest
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
            'title' => 'required|string',
            'body' => 'required_if:type,1|string',
            'titles' => 'required_if:type,2|json',
            'images' => 'required_if:type,2|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'type' => 'required|in:1,2',
        ];
    }
}
