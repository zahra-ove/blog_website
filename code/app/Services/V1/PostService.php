<?php

namespace App\Services\V1;

use App\DTO\Api\V1\PostDTO;
use App\Exceptions\CustomResourceException;
use App\Repositories\V1\contracts\PostRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostService
{
    public function __construct(protected PostRepositoryInterface $postRepository)
    {
    }

    public function store(PostDTO $postData, null|array $tags_id)
    {
        try {

            DB::beginTransaction();

            $post = $this->postRepository->store([
                'title' => htmlspecialchars($postData->title),
                'body'  => htmlspecialchars($postData->body),
                'published' => $postData->published,
                'author_id' => Auth::user()?->id,
                'category_id' => $postData->category_id
            ]);

            if($tags_id) {
                $post->tags()->attach($tags_id);
            }

            DB::commit();

        } catch(\Exception $e) {

            DB::rollBack();
            throw new CustomResourceException("creating post with tags failed");
        }
    }

    public function update(int $id, PostDTO $postData, null|array $tag_ids)
    {
        try {
            DB::beginTransaction();
            $post = $this->postRepository->find($id);

            // if article is already published, then the owner can not change the `publish_at` data.
            if($post->published_at != null && isset($postData->publish_at) && $post->publish_at!= $postData->publish_at) {
                throw new CustomResourceException('post already published!');

            } else {
                $result = $this->postRepository->update($id, $postData);
                if($tag_ids) {
                    $post->tags()->sync($tag_ids);
                }
            }

            DB::commit();
            return $result;

        } catch(\Exception $e) {

            DB::rollBack();
            throw new CustomResourceException("creating post with tags failed");
        }
    }
}
