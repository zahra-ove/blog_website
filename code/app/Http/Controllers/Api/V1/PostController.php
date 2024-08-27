<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Post\StoreRequest;
use App\Http\Requests\Api\V1\Post\UpdateRequest;
use App\Http\Resources\Api\V1\PostCollection;
use App\Http\Resources\Api\V1\PostResource;
use App\Repositories\V1\contracts\PostRepositoryInterface;
use App\Services\V1\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class PostController extends Controller
{
    public function __construct(protected PostRepositoryInterface $postRepository,
                                protected PostService $postService)
    {
    }

    public function index(): JsonResponse
    {
        $includes = request()->has('include') ? explode(',', request()->query('include')) : [];

        $resource = request()->has('paginated')
            ? new PostCollection($this->postRepository->paginate(relations: $includes))
            : PostResource::collection($this->postRepository->all(relations: $includes));

        return response()->json($resource, HttpResponse::HTTP_OK);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $post = $this->postService->store($request->toDto(), $request->validated('tag_ids'), $request->validated('tags'));
        return response()->json($post, HttpResponse::HTTP_CREATED);
    }

    public function show(int $id): JsonResponse
    {
        $includes = request()->has('include') ? explode(',', request()->query('include')) : [];
        $post = $this->postRepository->find($id, relations: $includes);
        return response()->json(new PostResource($post), HttpResponse::HTTP_OK);
    }

    public function update(UpdateRequest $request, string $id): JsonResponse
    {
        $result = $this->postService->update($id, $request->toDto(), $request->validated('tag_ids'), $request->validated('tags'));
        return response()->json($result, HttpResponse::HTTP_OK);
    }

    public function destroy(int $id): Response
    {
        $this->postRepository->destroy($id);
        return response(null,HttpResponse::HTTP_NO_CONTENT);
    }

    public function confirm(int $id): JsonResponse
    {
        return response()->json($this->postRepository->confirm($id),HttpResponse::HTTP_OK);
    }

    public function reject(int $id): JsonResponse
    {
        return response()->json($this->postRepository->reject($id),HttpResponse::HTTP_OK);
    }
}
