<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('genres')->group(function () {
    Route::get('/', [GenreController::class, 'index']);
    Route::post('/', [GenreController::class, 'store']);
    Route::get('/{genre}', [GenreController::class, 'show']);
    Route::put('/{genre}', [GenreController::class, 'update']);
    Route::delete('/{genre}', [GenreController::class, 'destroy']);
});


Route::prefix('movies')->group(function () {
    Route::get('/', [MovieController::class, 'index']);
    Route::post('/', [MovieController::class, 'store']);
    Route::get('/{movie}', [MovieController::class, 'show']);
    Route::put('/{movie}', [MovieController::class, 'update']);
    Route::put('/{movie}/publish', [MovieController::class, 'publish']);
    Route::delete('/{movie}', [MovieController::class, 'destroy']);
});

