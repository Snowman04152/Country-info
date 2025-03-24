<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;

// Halaman utama
Route::get('/', [CountryController::class, 'index']);

// Halaman detail negara
Route::get('/country/{name}', [CountryController::class, 'show']);

// Handle request pencarian
Route::get('/search', [CountryController::class, 'search']);