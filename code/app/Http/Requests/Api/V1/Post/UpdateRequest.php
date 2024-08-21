<?php

namespace App\Http\Requests\Api\V1\Post;

use App\DTO\Api\V1\PostDTO;
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
            'title'       => 'nullable|string|max:255',
            'body'        => 'nullable|string',
            'category_id' => 'nullable|numeric|exists:categories,id',
            'publish'     => 'nullable|bool',
            'publish_at'  => 'nullable|string|after_or_equal:now'
        ];
    }

    public function toDto(): PostDTO
    {
        return new PostDTO(
            title: $this->validated('title'),
            body: $this->validated('body'),
            category_id: $this->validated('category_id'),
            publish: $this->validated('publish'),
            publish_at: $this->validated('publish_at')
        );
    }
}
