<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/portfolio/create', function () {
    return view('portfolio.create');
})->name('portfolio.create');

Route::get('/portfolio/{portfolio}', [PortfolioController::class, 'show'])
    ->whereNumber('portfolio')
    ->name('portfolio.show');

Route::get('/portfolio/{portfolio}/templates', [PortfolioController::class, 'selectTemplate'])
    ->whereNumber('portfolio')
    ->name('portfolio.templates');

Route::post('/portfolio/{portfolio}/template', [
    PortfolioController::class,
    'updateTemplate'
])
    ->whereNumber('portfolio')
    ->name('portfolio.template.update');

Route::post('/portfolio', [PortfolioController::class, 'store'])
    ->name('portfolio.store');

Route::get('/portfolios', [PortfolioController::class, 'index'])
    ->name('portfolios.index');

Route::get('/portfolio/{portfolio}/edit', [PortfolioController::class, 'edit'])
    ->whereNumber('portfolio')
    ->name('portfolio.edit');

Route::put('/portfolio/{portfolio}', [PortfolioController::class, 'update'])
    ->whereNumber('portfolio')
    ->name('portfolio.update');

Route::delete('/portfolio/{portfolio}', [PortfolioController::class, 'destroy'])
    ->whereNumber('portfolio')
    ->name('portfolio.destroy');