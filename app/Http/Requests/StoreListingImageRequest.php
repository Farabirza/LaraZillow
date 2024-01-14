<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreListingImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'images.*' => 'mimes:png,jpg,jpeg|max:3000',
        ];
    }
    public function messages(): array
    {
        return [
            'images.*.mimes' => "The files should be either jpg, jpeg, or png",
            'images.*.max' => "The maximum file size allowed is 3 MB",
        ];
    }
}
