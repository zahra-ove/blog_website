<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\SavedPost\RemoveDirectoryRequest;
use App\Http\Requests\Api\V1\SavedPost\RemoveSavedPostRequest;
use App\Http\Requests\Api\V1\SavedPost\SavePostRequest;
use App\Services\V1\SavedService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class SavedController extends Controller
{
    public function __construct(protected SavedService $savedService)
    {
    }

    public function save_post(SavePostRequest $request): JsonResponse
    {
        $result = $this->savedService->save_post(
            post_id: $request->validated('post_id'),
            directory_name: $request->validated('directory_name')
        );

        return response()->json($result, HttpResponse::HTTP_OK);
    }

    public function remove_saved_post(int $post_id): JsonResponse
    {
        $result = $this->savedService->remove_saved_post($post_id);
        return response()->json($result, HttpResponse::HTTP_OK);
    }

    public function remove_saved_directory(RemoveDirectoryRequest $request): JsonResponse
    {
        $result = $this->savedService->remove_saved_directory($request->validated('directory_name'));
        return response()->json($result, HttpResponse::HTTP_OK);
    }

    public function move_post_to_new_directory(RemoveSavedPostRequest $request): JsonResponse
    {
        $result = $this->savedService->move_post_to_new_directory(
            post_id: $request->validated('post_id'),
            new_directory_name: $request->validated('new_directory_name'),
            old_directory_name: $request->validated('old_directory_name'),
        );
        return response()->json($result, HttpResponse::HTTP_OK);
    }
}
