<?php

use Illuminate\Support\Facades\Route;

// Route for the homepage
Route::get('/', function () {
    return view('accueil');
});

// Route for the homepage
Route::get('/index', function () {
    return view('index');
});

// Route pour la page d"tail d'article
Route::get('/article/{id}', function () {
    return view('article');
});

// Route pour la page favoris
Route::get('/favorites', function () {
    return view('favorites');
});

// Route pour la page de recherche
Route::get('/search', function () {
    return view('search');
});

// Route pour la page de recherche
Route::get('/login', function () {
    return view('login');
});

// Route pour la page de recherche
Route::get('/results', function () {
    return view('search-results');
});

// Route pour la page de recherche
Route::get('/readtime', function () {
    return view('readtime');
});
// In your routes/web.php or routes/api.php
Route::get('/banner', function() {
    $response = Http::get('https://playground.burotix.be/adv/banner_for_isfce.json');
    return response()->json($response->json());
});