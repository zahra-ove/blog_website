<?php

namespace App\Services\V1;

use App\DTO\Api\V1\PostDTO;
use App\Exceptions\CustomResourceException;
use App\Models\Tag;
use App\Repositories\V1\contracts\PostRepositoryInterface;
use App\Repositories\V1\contracts\TagRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PostService
{
    public function __construct(protected PostRepositoryInterface $postRepository, protected TagRepositoryInterface $tagRepository)
    {
    }

    public function store(PostDTO $postData, null|array $tag_ids, null|array $tags)
    {
        try {
            DB::beginTransaction();

            $post = $this->postRepository->store([
                'title'       => htmlspecialchars($postData->title),
                'body'        => htmlspecialchars($postData->body),
                'publish'     => $postData->publish,
                'publish_at'  => $postData->publish_at,
                'author_id'   => Auth::user()?->id,
                'category_id' => $postData->category_id
            ]);

            if($tag_ids) {
                $post->tags()->attach($tag_ids);
            }

            if($tags) {
                $tag_ids = $this->tagRepository->insertMany($tags);
                $post->tags()->attach($tag_ids);
            }

            DB::commit();
            return $post;

        } catch(\Exception $e) {
            DB::rollBack();

            Log::error('storing post failed!!', ['message' => $e->getMessage()]);
            Throw new CustomResourceException("creating post with tags failed");
        }
    }

    public function update(int $id, PostDTO $postData, null|array $tag_ids, null|array $tags)
    {
        try {
            DB::beginTransaction();

            $result = $this->postRepository->updateBySave($id, $postData->toArray());

            $post = $this->postRepository->find($id);
            if($tag_ids) {
                $post->tags()->sync($tag_ids);
            }

            if($tags) {
                $tag_ids = $this->tagRepository->insertMany($tags);
                $post->tags()->attach($tag_ids);
            }

            DB::commit();
            return $result;

        } catch(\Exception $e) {
            DB::rollBack();
            Log::error('post update failed', ['e' => $e->getMessage()]);
            throw new CustomResourceException("updating post with tags failed");
        }
    }
}
