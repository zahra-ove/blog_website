<?php

use App\Http\Controllers\Api\V1\CommentController;
use Illuminate\Support\Facades\Route;

Route::apiResource('comments', CommentController::class);
Route::get('comments/{id}/confirm', [CommentController::class, 'confirm'])->name('comments.confirm');   //@TODO: admin authorization
Route::get('comments/{id}/reject', [CommentController::class, 'reject'])->name('comments.reject');      //@TODO: admin authorization
