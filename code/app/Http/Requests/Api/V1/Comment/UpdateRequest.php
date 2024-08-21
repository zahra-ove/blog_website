<?php

namespace App\Http\Requests\Api\V1\Comment;

use App\DTO\Api\V1\CommentDTO;
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
            'body'       => 'nullable|string|max:10000',
            'post_id'    => 'nullable|numeric|exists:posts,id',
            'comment_id' => 'nullable|numeric|exists:comments,id'
        ];
    }

    public function toDto(): CommentDTO
    {
        return new CommentDTO(
            body: $this->validated('body'),
            user_id: $this->validated('user_id'),
            post_id: $this->validated('post_id')??null,
            comment_id: $this->validated('comment_id')
        );
    }
}
