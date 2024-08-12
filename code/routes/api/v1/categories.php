<?php


use App\Http\Controllers\api\V1\CategoryController;
use Illuminate\Support\Facades\Route;

Route::apiResource('categories', CategoryController::class)->except('show');
Route::get('categories/{id}', [CategoryController::class, 'findById'])->where('id', '[0-9]+')->name('categories.show');
Route::get('categories/{slug}', [CategoryController::class, 'findBySlug'])->where('slug', '[\w\-]+')->name('categories.show_by_slug');
