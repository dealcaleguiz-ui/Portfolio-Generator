<?php

use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

// Protected portfolio management routes
Route::middleware('auth')->group(function () {

Route::get('portfolios/{portfolio}/templates', [PortfolioController::class, 'templates'])->name('portfolios.templates');
Route::post('portfolios/{portfolio}/templates', [PortfolioController::class, 'chooseTemplate'])->name('portfolios.choose');

Route::resource('portfolios', PortfolioController::class);
});

Route::get('p/{portfolio}', [PortfolioController::class, 'publicShow'])
    ->name('portfolios.public');

