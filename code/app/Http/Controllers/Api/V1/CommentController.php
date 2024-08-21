<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Comment\StoreRequest;
use App\Http\Requests\Api\V1\Comment\UpdateRequest;
use App\Http\Resources\Api\V1\CommentCollection;
use App\Http\Resources\Api\V1\CommentResource;
use App\Repositories\V1\contracts\CommentRepositoryInterface;
use App\Services\V1\CommentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class CommentController extends Controller
{
    public function __construct(protected CommentRepositoryInterface $commentRepository, protected CommentService $commentService)
    {
    }

    public function index(): JsonResponse
    {
        $includes = request()->has('include') ? explode(',', request()->query('include')) : [];

        $resource = request()->has('paginated')
            ? new CommentCollection($this->commentRepository->paginate(relations: $includes))
            : CommentResource::collection($this->commentRepository->all(relations: $includes));

        return response()->json($resource, HttpResponse::HTTP_OK);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $comment = $this->commentService->store($request->toDto());
        return response()->json($comment, HttpResponse::HTTP_CREATED);
    }

    public function show(string $id): JsonResponse
    {
        $comment = $this->commentRepository->find($id);
        return response()->json($comment, HttpResponse::HTTP_OK);
    }

    public function update(UpdateRequest $request, string $id): JsonResponse
    {
        $result = $this->commentService->update($id, $request->toDto());
        return response()->json($result, HttpResponse::HTTP_OK);
    }

    public function destroy(string $id): Response
    {
        $this->commentRepository->destroy($id);
        return response('', HttpResponse::HTTP_NO_CONTENT);
    }

    public function confirm(int $id): JsonResponse
    {
        return response()->json(
            $this->commentRepository->confirm($id),
            HttpResponse::HTTP_OK
        );
    }

    public function reject(int $id): JsonResponse
    {
        return response()->json(
            $this->commentRepository->reject($id),
            HttpResponse::HTTP_OK
        );
    }
}
