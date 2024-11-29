<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Customer and Transaction routes for regular users
    Route::resource('customers', CustomerController::class)->only(['index', 'show']);
    Route::resource('transactions', TransactionController::class)->only(['index', 'show']);
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');

    // Admin-only routes
    Route::middleware('role:Admin')->group(function () {
        Route::get('customers/create', [CustomerController::class, 'create'])->name('customers.create');
        Route::get('transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
        Route::resource('customers', CustomerController::class)->except(['index', 'show']);
        Route::resource('transactions', TransactionController::class)->except(['index', 'show']);
        Route::resource('users', UserController::class)->only(['index', 'show']);
    });

    // Super Admin-only routes
    Route::middleware('role:super_admin')->group(function () {
        Route::get('customers/create', [CustomerController::class, 'create'])->name('customers.create');
        Route::get('transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
        Route::resource('customers', CustomerController::class)->except(['index', 'show']);
        Route::resource('transactions', TransactionController::class)->except(['index', 'show']);
        Route::resource('users', UserController::class)->except(['index', 'show']);
    });

});


require __DIR__ . '/auth.php';
