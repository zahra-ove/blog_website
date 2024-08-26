<?php

namespace App\Http\Requests\Api\V1\Post;

use App\DTO\Api\V1\PostDTO;
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
            'title'       => ['nullable', 'string', 'max:255', Rule::unique('posts', 'title')->ignore($this->id)],
            'body'        => 'nullable|string',
            'category_id' => 'nullable|numeric|exists:categories,id',
            'publish'     => 'nullable|bool',
            'publish_at'  => 'nullable|string|after_or_equal:now',

            'tag_ids'     => 'nullable|array',
            'tag_ids.*'   => 'numeric|exists:tags,id',
            'tags'        => 'nullable|array',
            'tags.*'      => 'required|string|max:100|unique:tags,name'
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'publish' => $this->input('publish', false)
        ]);
    }

    public function toDto(): PostDTO
    {
        return new PostDTO(
            title: $this->validated('title'),
            body: $this->validated('body'),
            category_id: $this->validated('category_id'),
            publish: $this->validated('publish'),
            publish_at: $this->validated('publish_at'),
        );
    }
}
