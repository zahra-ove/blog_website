<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Tag\StoreRequest;
use App\Http\Requests\Api\V1\Tag\UpdateRequest;
use App\Http\Resources\Api\V1\TagCollection;
use App\Http\Resources\Api\V1\TagResource;
use App\Repositories\V1\contracts\TagRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class TagController extends Controller
{

    public function __construct(protected TagRepositoryInterface $tagRepository)
    {
    }

    public function index(): JsonResponse
    {
        $includes = request()->has('include') ? explode(',', request()->query('include')) : [];

        $resource = request()->has('paginated')
            ? new TagCollection($this->tagRepository->paginate(relations: $includes))
            : TagResource::collection($this->tagRepository->all(relations: $includes));

        return response()->json($resource, HttpResponse::HTTP_OK);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $post = $this->tagRepository->store($request->validated());
        return response()->json($post, HttpResponse::HTTP_CREATED);
    }

    public function show(int $id): JsonResponse
    {
        $post = $this->tagRepository->find($id);
        return response()->json($post, HttpResponse::HTTP_OK);
    }

    public function update(UpdateRequest $request, string $id): JsonResponse
    {
        $result = $this->tagRepository->update($id, $request->validated());
        return response()->json($result, HttpResponse::HTTP_OK);
    }

    public function destroy(int $id): Response
    {
        $this->tagRepository->destroy($id);
        return response(null,HttpResponse::HTTP_NO_CONTENT);
    }
}
