<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\Category\StoreRequest;
use App\Http\Requests\Api\V1\Category\UpdateRequest;
use App\Http\Resources\Api\V1\CategoryResource;
use App\Repositories\V1\contracts\CategoryRepositoryInterface;
use App\Services\V1\CategoryService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


class CategoryController extends ApiController
{
    public function __construct(protected CategoryService $categoryService, protected CategoryRepositoryInterface $categoryRepository)
    {
    }

    public function index(): JsonResponse
    {
        $categories = request()->has('paginated')
            ? $this->categoryRepository->paginate()
            : $this->categoryRepository->all();

        $resource = CategoryResource::collection($categories);
        return response()->json($resource, Response::HTTP_OK);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $category = $this->categoryService->store($request->validated());
        return response()->json($category, Response::HTTP_CREATED);
    }

    public function findById(int $id): JsonResponse
    {
        $category = $this->categoryRepository->find($id);
        return response()->json($category, Response::HTTP_OK);
    }

    public function findBySlug(string $slug): JsonResponse
    {
        $category = $this->categoryRepository->findBySlug($slug);
        return response()->json($category, Response::HTTP_OK);
    }

    public function update(UpdateRequest $request, string $id): JsonResponse
    {
        $result = $this->categoryRepository->update($id, $request->validated());
        return response()->json($result, Response::HTTP_OK);
    }

    public function destroy(string $id): JsonResponse
    {
        $this->categoryRepository->destroy($id);
        return response()->json('', Response::HTTP_NO_CONTENT);
    }
}
