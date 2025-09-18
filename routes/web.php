<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\Home\BookingController as HomeBookingController;
use App\Http\Controllers\Home\PaymentController as HomePaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Home routes for public booking
Route::get('/fields', [HomeBookingController::class, 'index'])->name('home.fields.index');
Route::middleware('auth')->group(function () {
    Route::get('/booking/create', [HomeBookingController::class, 'create'])->name('home.booking.create');
    Route::get('/my-bookings', [HomeBookingController::class, 'myBookings'])->name('bookings.my-bookings');
    Route::post('/booking', [HomeBookingController::class, 'store'])->name('home.bookings.store');
});
//productions
Route::post('/midtrans/callback', [HomeBookingController::class, 'callback']);
//dev
Route::get('/payment/check/{bookingId}', [HomeBookingController::class, 'checkStatus']);



Route::prefix('dashboard')->middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('fields', FieldController::class);
    Route::resource('bookings', BookingController::class);
    Route::resource('payments', PaymentController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
