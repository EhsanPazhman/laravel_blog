<?php

namespace App\Http\Requests\Admin\Posts;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'title' => 'sometimes|string|min:3',
            'category_id' => 'sometimes|exists:categories,id',
            'content'     => 'sometimes|string|min:20',
            'image'       => 'sometimes|image|mimes:png,jpg,jpeg',
        ];
    }
}
