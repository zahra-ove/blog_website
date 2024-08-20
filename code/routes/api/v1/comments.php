<?php

use App\Http\Controllers\Api\V1\CommentController;
use Illuminate\Support\Facades\Route;

Route::apiResource('comments', CommentController::class);
