<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/genres', [GenreController::class, 'index']);
Route::post('/genres', [GenreController::class, 'store']);
Route::get('/genres/{genre}', [GenreController::class, 'show']);
Route::put('/genres/{genre}', [GenreController::class, 'update']);
Route::delete('/genres/{genre}', [GenreController::class, 'destroy']);

Route::get('/movies', [MovieController::class, 'index']);
Route::post('/movies', [MovieController::class, 'store']);
Route::get('/movies/{movie}', [MovieController::class, 'show']);
Route::put('/movies/{movie}', [MovieController::class, 'update']);
Route::put('/movies/{movie}/publish', [MovieController::class, 'publish']);
Route::delete('/movies/{movie}', [MovieController::class, 'destroy']);
