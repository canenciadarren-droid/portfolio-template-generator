<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/portfolio/create', function () {
    return view('portfolio.create');
})->name('portfolio.create');

Route::post('/portfolio', [PortfolioController::class, 'store'])
    ->name('portfolio.store');