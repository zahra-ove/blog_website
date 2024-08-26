<?php


use App\Http\Controllers\Api\V1\PostController;
use Illuminate\Support\Facades\Route;

Route::apiResource('posts', PostController::class);
Route::get('/post/{id}/confirm', [PostController::class, 'confirm'])->name('posts.confirm');   //@TODO: admin permission
Route::get('/post/{id}/reject', [PostController::class, 'reject'])->name('posts.reject');   //@TODO: admin permission
