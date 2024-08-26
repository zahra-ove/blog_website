<?php


use App\Http\Controllers\api\V1\CategoryController;
use Illuminate\Support\Facades\Route;

Route::apiResource('categories', CategoryController::class);
Route::get('categories/find-by-slug/{slug}', [CategoryController::class, 'findBySlug'])->where('slug', '[\w\-]+')->name('categories.show_by_slug');
