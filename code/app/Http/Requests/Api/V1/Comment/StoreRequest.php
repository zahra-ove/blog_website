<?php

namespace App\Http\Requests\Api\V1\Comment;

use App\DTO\Api\V1\CommentDTO;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'body'       => 'required|string|max:10000',
            'post_id'    => 'required|numeric|exists:posts,id',
            'comment_id' => 'required|numeric|exists:comments,id'
        ];
    }

    public function toDto(): CommentDTO
    {
        return new CommentDTO(
            body: $this->validated('body'),
            user_id: $this->validated('user_id'),
            post_id: $this->validated('post_id'),
            comment_id: $this->validated('comment_id')
        );
    }
}
