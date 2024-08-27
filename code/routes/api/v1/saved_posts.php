<?php

use App\Http\Controllers\Api\V1\SavedController;
use Illuminate\Support\Facades\Route;

Route::post('saved/save-post', [SavedController::Class, 'save_post'])->name('saved.add-post');
Route::get('saved/remove-post/{post_id}', [SavedController::Class, 'remove_saved_post'])->name('saved.remove-post');
Route::post('saved/remove-directory', [SavedController::Class, 'remove_saved_directory'])->name('saved.remove-directory');
Route::post('saved/move-post', [SavedController::Class, 'move_post_to_new_directory'])->name('saved.move-post');
