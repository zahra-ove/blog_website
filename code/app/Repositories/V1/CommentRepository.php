<?php

namespace App\Repositories\V1;

use App\Models\Comment;
use App\Repositories\V1\contracts\CommentRepositoryInterface;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{
    public function __construct(Comment $comment)
    {
        parent::__construct($comment);
    }

    public function confirm(int $id): bool
    {
        $comment = Comment::firstOrFail($id);

        return $comment->update([
            'confirmed' => 'confirmed'
        ]);
    }

    public function reject(int $id): bool
    {
        $comment = Comment::firstOrFail($id);

        return $comment->update([
            'confirmed' => 'rejected'
        ]);
    }
}
