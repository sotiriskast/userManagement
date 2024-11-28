<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Customer Routes
    Route::get('customers/create', [CustomerController::class, 'create'])->name('customers.create');

    Route::resource('customers', CustomerController::class)->only(['index', 'show']);

    Route::middleware('role:Admin')->group(function () {
        Route::get('transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
        Route::resource('customers', CustomerController::class)->except(['index', 'show']);
    });

    // Transaction Routes
    Route::resource('transactions', TransactionController::class)->only(['index', 'show']);

    Route::middleware('role:Admin')->group(function () {
        Route::resource('transactions', TransactionController::class)->except(['index', 'show']);
    });
});

require __DIR__.'/auth.php';
