<?php

namespace App\Services\V1;

use App\DTO\Api\V1\PostDTO;
use App\Exceptions\CustomResourceException;
use App\Repositories\V1\contracts\PostRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class PostService
{
    public function __construct(protected PostRepositoryInterface $postRepository)
    {
    }

    public function store(PostDTO $postData)
    {
        return $this->postRepository->store([
            'title' => htmlspecialchars($postData->title),
            'body'  => htmlspecialchars($postData->body),
            'published' => $postData->published,
            'author_id' => Auth::user()?->id,
            'category_id' => $postData->category_id
        ]);
    }

    public function update(int $id, PostDTO $postData)
    {
        $post = $this->postRepository->find($id);
        if(isset($data['publish_at'])) {
            if($post->published_at != null) {
                throw new CustomResourceException('post already published!');
            }
        }

        return $this->postRepository->update($id, $postData);
    }
}
