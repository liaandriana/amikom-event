<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\EventController as UserEventController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\PartnerController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/event/1', [UserEventController::class, 'show']);
Route::get('/checkout', [UserEventController::class, 'checkout']);
Route::get('/my-ticket', [UserEventController::class, 'ticket']);

Route::get('/', [WelcomeController::class, 'index'])
    ->name('welcome');

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');

    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');

    Route::resource('events', EventController::class);

    Route::resource('categories', CategoryController::class);

    Route::resource('partners', PartnerController::class);
});