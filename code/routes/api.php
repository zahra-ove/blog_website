<?php

use App\Http\Controllers\api\V1\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//@TODO: add JWT authentication/authorization
//Route::middleware(['auth:sanctum'])->prefix('v1')->as('v1:')->group(function(){
Route::middleware([])->prefix('v1')->as('v1:')->group(function(){
    require base_path('routes/api/v1/categories.php');
    require base_path('routes/api/v1/posts.php');
    require base_path('routes/api/v1/comments.php');
    require base_path('routes/api/v1/tags.php');
    require base_path('routes/api/v1/saved_posts.php');
});



