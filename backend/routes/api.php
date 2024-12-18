<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('movies', App\Http\Controllers\MovieController::class);
Route::apiResource('categories', App\Http\Controllers\CategoryController::class);
