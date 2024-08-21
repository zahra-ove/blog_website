<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Post\StoreRequest;
use App\Http\Requests\Api\V1\Post\UpdateRequest;
use App\Http\Resources\Api\V1\PostCollection;
use App\Repositories\V1\contracts\PostRepositoryInterface;
use App\Services\V1\PostService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function __construct(protected PostRepositoryInterface $postRepository,
                                protected PostService $postService)
    {
    }

    public function index(): JsonResponse
    {
        $includes = request()->has('include') ? explode(',', request()->query('include')) : [];

        $posts = request()->has('paginated')
            ? $this->postRepository->paginate(relations: $includes)
            : $this->postRepository->all(relations: $includes);

        $resource = new PostCollection($posts);
        return response()->json($resource, Response::HTTP_OK);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $post = $this->postRepository->store($request->validated());
        return response()->json($post, Response::HTTP_CREATED);
    }

    public function show(int $id): JsonResponse
    {
        $post = $this->postRepository->find($id);
        return response()->json($post, Response::HTTP_OK);
    }

    public function update(UpdateRequest $request, string $id): JsonResponse
    {
        $result = $this->postService->update($id, $request->validated());
        return response()->json($result, Response::HTTP_OK);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->postRepository->destroy($id);
        return response()->json('', Response::HTTP_NO_CONTENT);
    }
}
