<?php

namespace App\Http\Requests\Api\V1\SavedPost;

use Illuminate\Foundation\Http\FormRequest;

class RemoveDirectoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'directory_name' => 'required|string|max:255'
        ];
    }
}
