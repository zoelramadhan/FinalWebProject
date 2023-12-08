<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\DashboardController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('homepage');
Route::get('detail/{car:slug}', [HomeController::class, 'detail'])->name('detail');


// user
Route::get('/user', [UserController::class, 'index'])->name('user.index');
Route::get('/user/car', [UserController::class, 'car'])->name('user.car');
Route::get('/user/driver', [UserController::class, 'driver'])->name('user.driver');
Route::get('detail/{car:slug}', [UserController::class, 'detail'])->name('user.detail');
Route::get('payment', [UserController::class, 'payment'])->name('payment');
Route::post('payment', [UserController::class, 'paymentStore'])->name('payment.store');
Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
Route::post('/user/profile/update', [UserController::class, 'updateProfile'])->name('user.profile.update');
Route::get('user/search', [UserController::class, 'search'])->name('user.search');

// admin
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function() {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('cars', CarController::class);
    Route::put('cars/update-image/{id}', [CarController::class, 'updateImage'])->name('cars.updateImage');

    Route::resource('drivers', DriverController::class);
    Route::put('drivers/update-image/{id}', [DriverController::class, 'updateImage'])->name('drivers.updateImage');

    
    Route::get('payments', [PaymentController::class, 'index'])->name('payments.index');
    Route::put('payment/{payment}/approve', [PaymentController::class, 'approvePayment'])->name('admin.payment.approve');
    Route::put('payment/{payment}/reject', [PaymentController::class, 'rejectPayment'])->name('admin.payment.reject');
    Route::delete('payments/{payment}', [PaymentController::class, 'destroy'])->name('payments.destroy');
});


Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
