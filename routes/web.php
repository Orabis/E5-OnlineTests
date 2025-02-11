<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\DmController;
use Illuminate\Support\Facades\Route;

// `/quiz/{token}`

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('homepage');
    Route::get('/login', [UserController::class, 'index'])->name('login');
    Route::post('/login', [UserController::class, 'login'])->name('login.submit');
    Route::post('/register', [UserController::class, 'create'])->name('register.submit');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    Route::get('/dms', [DMController::class, 'index'])->name('dms.index');
    Route::get('/dms/create', [DMController::class, 'create'])->name('dms.create');
    Route::post('/dms', [DMController::class, 'store'])->name('dms.store');
    Route::delete('/dms/{id}', [DMController::class, 'destroy'])->name('dms.destroy');


});