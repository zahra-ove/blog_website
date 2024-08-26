<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\Category\StoreRequest;
use App\Http\Requests\Api\V1\Category\UpdateRequest;
use App\Http\Resources\Api\V1\CategoryCollection;
use App\Http\Resources\Api\V1\CategoryResource;
use App\Repositories\V1\contracts\CategoryRepositoryInterface;
use App\Services\V1\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as HttpResponse;


class CategoryController extends ApiController
{
    public function __construct(protected CategoryService $categoryService, protected CategoryRepositoryInterface $categoryRepository)
    {
    }

    public function index(): JsonResponse
    {
        $includes = request()->has('include') ? explode(',', request()->query('include')) : [];

        $resource = request()->has('paginated')
            ? new CategoryCollection($this->categoryRepository->paginate(relations: $includes))
            : CategoryResource::collection($this->categoryRepository->all(relations: $includes));

        return response()->json($resource, HttpResponse::HTTP_OK);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $category = $this->categoryService->store($request->validated());
        return response()->json($category, HttpResponse::HTTP_CREATED);
    }

    public function show(int $id): JsonResponse
    {
        $category = $this->categoryRepository->find($id);
        return response()->json($category, HttpResponse::HTTP_OK);
    }

    public function findBySlug(string $slug): JsonResponse
    {
        $category = $this->categoryRepository->findBySlug($slug);
        return response()->json($category, HttpResponse::HTTP_OK);
    }

    public function update(UpdateRequest $request, string $id): JsonResponse
    {
        $result = $this->categoryRepository->update($id, $request->validated());
        return response()->json($result, HttpResponse::HTTP_OK);
    }

    public function destroy(string $id): Response
    {
        $this->categoryRepository->destroy($id);
        return response(null, HttpResponse::HTTP_NO_CONTENT);
    }
}
