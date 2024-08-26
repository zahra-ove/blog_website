<?php

namespace App\Repositories\V1;

use App\Exceptions\CustomResourceException;
use App\Models\Post;
use App\Repositories\V1\contracts\PostRepositoryInterface;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    public function __construct(Post $post)
    {
        parent::__construct($post);
    }

    public function updateBySave(int $id, array $postData): bool
    {
        $post = $this->find($id);
        $post->title = $postData['title'];
        $post->body = $postData['body'];
        $post->publish = $postData['publish'];
        $post->category_id = $postData['category_id'];

        // if article is already published, then the owner can not change the `publish_at` data.
        if($post->published_at != null && isset($postData['publish_at']) && $post->publish_at!= $postData['publish_at']) {
            throw new CustomResourceException('post already published!');
        } else {
            $post->publish_at = $postData['publish_at'];
        }

        return $post->save();
    }

    public function confirm(int $id): bool
    {
//        $post = $this->find($id);
//        $post->status = 'confirmed';
//        return $post->save();

        return Post::where('id', $id)->update(['status' => 'confirmed']);
    }

    public function reject(int $id): bool
    {
        return Post::where('id', $id)->update(['status' => 'confirmed']);
    }
}
