<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// for api documentation
Route::get('/docs', function () {
    return view('swagger.index');
});
