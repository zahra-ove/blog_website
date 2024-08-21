<?php

namespace App\Http\Requests\Api\V1\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => 'nullable|string|max:255',
            'slug'        => 'nullable|string|max:400',
            'category_id' => 'nullable|numeric|exists:category,id'
        ];
    }
}
