<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\user\FasilitasController;
use App\Http\Controllers\user\ReservasiController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\admin\AdminUserController;
use App\Http\Controllers\admin\AdminRoomsController;
use App\Http\Controllers\admin\AdminReservationsController;
use App\Http\Controllers\admin\AdminPaymentsMethodeController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\admin\AdminPaymentsController;
use App\Http\Controllers\admin\AdminLaporanController;

Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->role_id === 1) {
            return app()->make(AdminController::class)->index();
        }
        if (Auth::user()->role_id === 2) {
            return app()->make(UserController::class)->index();
        }
    }
    return app()->make(WelcomeController::class)->index();
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('/')->name('admin.')->group(function () {
    Route::resource('user', AdminUserController::class)->names([
        'index' => 'user',
        'store' => 'user.store',
        'update' => 'user.update',
        'destroy' => 'user.destroy',
    ]);
    Route::resource('rooms', AdminRoomsController::class)->names([
        'index' => 'rooms',
        'store' => 'rooms.store',
        'update' => 'rooms.update',
        'destroy' => 'rooms.destroy',
    ]);
    Route::resource('reservation', AdminReservationsController::class)->names([
        'index' => 'reservation',
        'store' => 'reservation.store',
        'update' => 'reservation.update',
        'destroy' => 'reservation.destroy',
    ]);
    Route::resource('payment_method', AdminPaymentsMethodeController::class)->names([
        'index' => 'payment_method',
        'store' => 'payment_method.store',
        'update' => 'payment_method.update',
        'destroy' => 'payment_method.destroy',
    ]);
    Route::resource('payments', AdminPaymentsController::class)->names([
        'index' => 'payments',
        'store' => 'payments.store',
        'update' => 'payments.update',
        'destroy' => 'payments.destroy',
    ]);
    Route::get('payments/{payment}/struk', [AdminPaymentsController::class, 'printStruk'])->name('payments.struk');
    Route::controller(AdminLaporanController::class)->group(function () {
        Route::get('laporan', 'index')->name('laporan');
        Route::get('laporan/pdf', 'generatePDF')->name('laporan.pdf');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('/fasilitas', [FasilitasController::class, 'index'])->name('fasilitas');
    Route::get('/reservasi', [ReservasiController::class, 'index'])->name('reservasi');
    Route::post('/reservations', [ReservasiController::class, 'store'])->name('reservations.store');
    Route::get('/status-reservasi', [ReservasiController::class, 'status'])->name('status-reservasi');
    Route::post('/reservations/{reservation}/upload-payment', [ReservasiController::class, 'uploadPayment'])
        ->name('reservations.upload-payment');
    Route::post('/reservations/{reservation}/cancel', [ReservasiController::class, 'cancel'])
        ->name('reservations.cancel');
});

require __DIR__ . '/auth.php';