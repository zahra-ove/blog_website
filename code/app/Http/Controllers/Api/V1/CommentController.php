<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\CommentCollection;
use App\Http\Resources\Api\V1\CommentResource;
use App\Repositories\V1\contracts\CommentRepositoryInterface;
use App\Services\V1\CommentService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    public function __construct(protected CommentRepositoryInterface $commentRepository, protected CommentService $commentService)
    {
    }

    public function index()
    {
        $includes = request()->has('include') ? explode(',', request()->query('include')) : [];

        $resource = request()->has('paginated')
            ? new CommentCollection($this->commentRepository->paginate(relations: $includes))
            : CommentResource::collection($this->commentRepository->all(relations: $includes));

        return response()->json($resource, 200);
    }

    public function store(Request $request)
    {
        $comment = $this->commentRepository->store($request->validated());
        return response()->json($comment, Response::HTTP_CREATED);
    }

    public function show(string $id)
    {
        $comment = $this->commentRepository->find($id);
        return response()->json($comment, Response::HTTP_OK);
    }

    public function update(Request $request, string $id)
    {
        $result = $this->commentService->update($id, $request->validated());
        return response()->json($result, Response::HTTP_OK);
    }

    public function destroy(string $id)
    {
        $this->commentRepository->destroy($id);
        return response()->json('', Response::HTTP_NO_CONTENT);
    }

    public function confirm(int $id)
    {
        return $this->commentRepository->confirm($id);
    }

    public function reject(int $id)
    {
        return $this->commentRepository->reject($id);
    }
}
