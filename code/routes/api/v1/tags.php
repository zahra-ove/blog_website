<?php

use App\Http\Controllers\Api\V1\TagController;
use Illuminate\Support\Facades\Route;

Route::apiResource('tags', TagController::class);
