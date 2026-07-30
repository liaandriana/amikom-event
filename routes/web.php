<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\EventController as UserEventController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Organization\AuthController as OrganizationAuthController;
use App\Http\Controllers\Organization\DashboardController as OrganizationDashboardController;
use App\Http\Controllers\Organization\EventController as OrganizationEventController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MidtransWebhookController;
use App\Http\Controllers\Admin\JabatanController;
use App\Http\Controllers\Admin\PengurusController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ReviewController;

Route::get('/', [WelcomeController::class, 'index'])
    ->name('welcome');

Route::get('/event/{id}', [UserEventController::class, 'show'])
    ->name('events.show');

Route::get('/checkout', [UserEventController::class, 'checkout']);

Route::get('/my-ticket', [UserEventController::class, 'ticket'])
    ->name('my-ticket');


// =========================
// CHECKOUT & PAYMENT
// =========================

Route::middleware('auth')->group(function () {

    Route::get('/checkout/{event}', [CheckoutController::class, 'create'])
        ->name('checkout.create');

    Route::post('/checkout/{event}', [CheckoutController::class, 'store'])
        ->name('checkout.store');

});

Route::get('/payment/{order_id}', [CheckoutController::class, 'payment'])
    ->name('checkout.payment');

Route::post('/midtrans/webhook', [MidtransWebhookController::class, 'handle'])
    ->name('midtrans.webhook');

    Route::get('/checkout/success/{order_id}', [CheckoutController::class, 'success'])
    ->name('checkout.success');


// =========================
// LOGIN
// =========================

Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');


// =========================
// REVIEW USER
// =========================

Route::middleware('auth')->group(function () {

    Route::post('/review/{transaction}', [ReviewController::class, 'store'])
        ->name('review.store');

});

Route::get('/auth/google', [GoogleController::class, 'redirect'])
    ->name('google.login');

Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

// =========================
// ORGANIZATION LOGIN
// =========================

Route::prefix('organization')
    ->name('organization.')
    ->group(function () {

        Route::get('register', [OrganizationAuthController::class, 'showRegister'])
        ->name('register');

        Route::post('register', [OrganizationAuthController::class, 'register'])
            ->name('register.post');

        Route::get('login', [OrganizationAuthController::class, 'showLogin'])
            ->name('login');

        Route::post('login', [OrganizationAuthController::class, 'login'])
            ->name('login.post');

        Route::post('logout', [OrganizationAuthController::class, 'logout'])
            ->name('logout');
    });

// =========================
// ORGANIZATION
// =========================

Route::prefix('organization')
    ->name('organization.')
    ->middleware('auth:organization')
    ->group(function () {

        Route::get('/dashboard', [OrganizationDashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('events', OrganizationEventController::class);

    });



// =========================
// ADMIN
// =========================
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('login', [AdminAuthController::class, 'showLogin'])
    ->name('login');

    Route::post('login', [AdminAuthController::class, 'login'])
        ->name('login.post');

    Route::post('logout', [AdminAuthController::class, 'logout'])
        ->name('logout');

    Route::middleware(['auth', 'admin'])->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Transaction
        Route::get('/transactions', [TransactionController::class, 'index'])
            ->name('transactions.index');

        // Event
        Route::resource('events', EventController::class);

        // Category
        Route::resource('categories', CategoryController::class);

        // Partner
        Route::resource('partners', PartnerController::class);

        // Jabatan
        Route::resource('jabatan', JabatanController::class);

        // Pengurus
        Route::resource('pengurus', PengurusController::class);

    });

    Route::middleware('auth')->group(function () {

    Route::get('/my-ticket', [UserEventController::class, 'ticket'])
        ->name('my-ticket');

});

});