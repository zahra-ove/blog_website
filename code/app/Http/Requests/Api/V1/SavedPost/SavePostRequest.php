<?php

namespace App\Http\Requests\Api\V1\SavedPost;

use Illuminate\Foundation\Http\FormRequest;

class SavePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'post_id' => 'required|numeric|exists:posts,id',
            'directory_name' => 'nullable|string|max:100'
        ];
    }
}
