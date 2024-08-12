<?php

use App\Http\Controllers\api\V1\CategoryController;
use Illuminate\Support\Facades\Route;

Route::name('blog.api.')
    ->prefix('v1')
    ->namespace('\App\Http\Controllers\api\v1')
    ->group(function () {
        Route::apiResource('categories', 'CategoryController')->except('show');
        Route::get('categories/{id}', [CategoryController::class, 'findById'])->where('id', '[0-9]+');
        Route::get('categories/{slug}', [CategoryController::class, 'findBySlug'])->where('slug', '[\w\-]+');
    });
