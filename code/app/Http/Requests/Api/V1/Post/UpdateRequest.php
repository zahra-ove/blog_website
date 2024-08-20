<?php

namespace App\Http\Requests\Api\V1\Post;

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
            'title'       => 'nullable|string|max:1000',
            'body'        => 'nullable|string',
            'category_id' => 'nullable|numeric|exists:categories,id',
//            'publish_at'  => 'nullable|date_format:Y-m-d H:i:s|after_or_equal:now'
            'publish_at'  => 'nullable|after_or_equal:now'
        ];
    }
}
