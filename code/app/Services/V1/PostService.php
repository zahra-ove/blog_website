<?php

namespace App\Services\V1;

use App\Exceptions\CustomResourceException;
use App\Repositories\V1\contracts\PostRepositoryInterface;

class PostService
{
    public function __construct(protected PostRepositoryInterface $postRepository)
    {
    }

    public function update(int $id, array $data)
    {
        $post = $this->postRepository->find($id);
        if(isset($data['publish_at'])) {
            if($post->published_at != null) {
                throw new CustomResourceException('post already published!');
            }
        }

        return $this->postRepository->update($id, $data);
    }
}
