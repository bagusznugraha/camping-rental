<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\VisitorController;
/*
|--------------------------------------------------------------------------
| HALAMAN UMUM
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/camping', [EquipmentController::class, 'customer'])
    ->name('customer.equipment');

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('categories', CategoryController::class);

    Route::resource('equipment', EquipmentController::class);

    Route::get('/users', [UserController::class, 'index'])
    ->name('users.index');

    Route::get('/customers', [CustomerController::class, 'index'])
    ->name('customers.index');

    Route::get('/visitors', [VisitorController::class, 'index'])
    ->name('visitors.index');

    /*
    |--------------------------------------------------------------------------
    | RENTAL
    |--------------------------------------------------------------------------
    */

    Route::get('/rentals', [RentalController::class, 'index'])
        ->name('rentals.index');

    Route::get('/rentals/{rental}', [RentalController::class, 'show'])
        ->name('rentals.show');

    Route::put('/rentals/{rental}/process', [RentalController::class, 'processRental'])
        ->name('rentals.process');

    Route::put('/rentals/{rental}/ship', [RentalController::class, 'shipRental'])
        ->name('rentals.ship');

    Route::put('/rentals/{rental}/pickup', [RentalController::class, 'readyPickup'])
        ->name('rentals.pickup');

    Route::put('/rentals/{rental}/start', [RentalController::class, 'startRental'])
        ->name('rentals.start');

    /*
    |--------------------------------------------------------------------------
    | RETURN
    |--------------------------------------------------------------------------
    */

    Route::get('/returns', [RentalController::class, 'returns'])
        ->name('returns.index');

    Route::put('/returns/{rental}', [RentalController::class, 'returnEquipment'])
        ->name('returns.store');

    /*
    |--------------------------------------------------------------------------
    | PAYMENT
    |--------------------------------------------------------------------------
    */

    Route::get('/payments', [PaymentController::class, 'index'])
        ->name('payments.index');

    Route::get('/payments/{payment}', [PaymentController::class, 'detail'])
        ->name('payments.show');

    Route::put('/payments/{payment}/approve', [PaymentController::class, 'approve'])
        ->name('payments.approve');

    Route::put('/payments/{payment}/reject', [PaymentController::class, 'reject'])
        ->name('payments.reject');

        Route::put('/payments/{payment}/cash', [PaymentController::class, 'cashPayment'])
    ->name('payments.cash');

    Route::post('/payment/{rental}/cash-request',
[PaymentController::class,'cashRequest'])
->name('payment.cashRequest');

    /*
    |--------------------------------------------------------------------------
    | REPORT
    |--------------------------------------------------------------------------
    */

    Route::get('/reports', [ReportController::class, 'index'])
        ->name('reports.index');
});

/*
|--------------------------------------------------------------------------
| PELANGGAN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | RENT
    |--------------------------------------------------------------------------
    */

    Route::get('/rent', [RentalController::class, 'create'])
        ->name('rent.create');

    Route::post('/rent', [RentalController::class, 'store'])
        ->name('rent.store');

    /*
    |--------------------------------------------------------------------------
    | PAYMENT
    |--------------------------------------------------------------------------
    */

    Route::get('/payment', [PaymentController::class, 'show'])
        ->name('payment.show');

    Route::post('/payment/{rental}/upload', [PaymentController::class, 'upload'])
        ->name('payment.upload');

        Route::post('/payment/{rental}/upload-remaining', [PaymentController::class, 'uploadRemaining'])
    ->name('payment.uploadRemaining');

        /*
|--------------------------------------------------------------------------
| NOTIFICATION
|--------------------------------------------------------------------------
*/

Route::get('/notifications', [NotificationController::class, 'index'])
    ->name('notifications.index');

Route::get('/notifications/{notification}', [NotificationController::class, 'read'])
    ->name('notifications.read');

Route::put('/notifications/read-all', [NotificationController::class, 'readAll'])
    ->name('notifications.readAll');

    /*
    |--------------------------------------------------------------------------
    | REVIEW
    |--------------------------------------------------------------------------
    */

    // Form review setelah penyewaan selesai
    Route::get('/review/{rental}', [ReviewController::class, 'create'])
        ->name('review.create');

    // Simpan review
    Route::post('/review/{rental}', [ReviewController::class, 'store'])
        ->name('review.store');


        
    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::get('/profile/rental/{rental}', [ProfileController::class, 'detailRental'])
        ->name('profile.rental.detail');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';