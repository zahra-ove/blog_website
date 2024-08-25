<?php

namespace App\Http\Requests\Api\V1\Tag;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required','string', 'max:100', Rule::unique('tags', 'name')->ignore($this->id),]
        ];
    }
}
