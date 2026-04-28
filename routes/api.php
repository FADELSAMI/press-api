<?php

require_once app_path('Http/Controllers/Api/favorite_ajax.php');

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\FavoriteAjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\UserController;


Route::get('articles', [ArticleController::class, 'index']);
Route::get('articles/{id}', [ArticleController::class, 'show']);
Route::post('articles/favorite/{id}', [ArticleController::class, 'addFavorite']);
Route::delete('articles/favorite/{id}', [ArticleController::class, 'removeFavorite']);

Route::get('/article/favorites', [ArticleController::class, 'showFavorites']);

Route::get('search', [ArticleController::class, 'search']);

Route::get('category', [CategoryController::class, 'index']);

Route::get('readTime', [ArticleController::class, 'readTime']);

Route::post('/login', [UserController::class, 'handleLogin']);

Route::prefix('favorites')->group(function () {
    Route::get('/', [FavoriteAjaxController::class, 'index']);
    Route::post('/add/{id}', [FavoriteAjaxController::class, 'add']);
    Route::post('/remove/{id}', [FavoriteAjaxController::class, 'remove']);
    Route::post('/clear', [FavoriteAjaxController::class, 'clear']);
});
