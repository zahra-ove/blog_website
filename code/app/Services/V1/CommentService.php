<?php

namespace App\Services\V1;

use App\DTO\Api\V1\CommentDTO;
use App\Exceptions\CustomResourceException;
use App\Models\Comment;
use App\Repositories\V1\contracts\CommentRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class CommentService
{
    public function __construct(protected CommentRepositoryInterface $commentRepository)
    {
    }

    public function store(CommentDTO $commentData)
    {
        return $this->commentRepository->store([
            'body'       => htmlspecialchars($commentData->body, ENT_QUOTES, 'UTF-8'),
            'user_id'    => Auth::user()?->id,
            'post_id'    => $commentData->post_id,
            'comment_id' => $commentData->comment_id
        ]);
    }

    public function update(int $id, CommentDTO $commentData)
    {
        $comment = $this->commentRepository->find($id);
        if($comment->confirmed == '1') {
            throw new CustomResourceException('can not update the confirmed comment.');
        }

        return $this->commentRepository->update($id, [
            'body' => htmlspecialchars($commentData->body, ENT_QUOTES, 'UTF-8'),
        ]);
    }
}
