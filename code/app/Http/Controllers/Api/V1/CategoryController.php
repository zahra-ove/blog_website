<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\CategoryStoreRequest;
use App\Http\Requests\Api\V1\CategoryUpdateRequest;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Repositories\contracts\CategoryRepositoryInterface;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;


class CategoryController extends ApiController
{
    public function __construct(protected CategoryService $categoryService, protected CategoryRepositoryInterface $categoryRepository)
    {
    }

    public function index(): JsonResponse
    {
        $categories = request()->has('paginated')
            ? $this->categoryRepository->paginate(5)
            : $this->categoryRepository->all();

        $resource = request()->has('paginated')
            ? new CategoryCollection($categories)
            : CategoryResource::collection($categories);

        return response()->json($resource, Response::HTTP_OK);
    }

    public function store(CategoryStoreRequest $request): JsonResponse
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
        $category = $this->categoryRepository->findBy('slug', $slug);
        return response()->json($category, Response::HTTP_OK);
    }

    public function update(CategoryUpdateRequest $request, string $id)
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
