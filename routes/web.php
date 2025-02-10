<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//  `/`: Page d'accueil (accessible à tout le monde)
//  `/prof/login`: Page de connexion pour le professeur
// `/prof/dashboard`: Page principale pour la gestion des DM (réservée aux profs après connexion)
// `/quiz/{token}`

Route::middleware('guest')->group(function () {
    Route::get('/prof/login', [UserController::class, 'showLoginForm'])->name('login');
    Route::post('/prof/login', [UserController::class, 'login'])->name('prof.login.submit');
    Route::post('/prof/register', [UserController::class, 'register'])->name('prof.register.submit');
});

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/prof/dashboard', [UserController::class, 'dashboard'])->name('prof.dashboard');
    Route::post('/prof/logout', [UserController::class, 'logout'])->name('prof.logout');
});