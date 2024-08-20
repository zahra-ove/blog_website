<?php

namespace App\Services\V1;

use App\Exceptions\CustomResourceException;
use App\Models\Comment;
use App\Repositories\V1\CommentRepository;

class CommentService
{
    public function __construct(protected CommentRepository $commentRepository)
    {
    }

    public function store(array $data): Comment
    {

    }

    public function update(int $id, array $data)
    {
        $comment = $this->commentRepository->find($id);
        if($comment->confirmed == '1') {
            throw new CustomResourceException('can not update the confirmed comment.');
        }

        return $this->commentRepository->update($id, $data);
    }
}
