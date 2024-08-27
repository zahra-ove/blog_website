<?php

namespace App\Http\Requests\Api\V1\SavedPost;

use Illuminate\Foundation\Http\FormRequest;

class RemoveSavedPostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'old_directory_name' => 'required|string|max:255',
            'new_directory_name' => 'required|string|max:255',
            'post_id'            => 'required|numeric|exists:posts,id'
        ];
    }
}
