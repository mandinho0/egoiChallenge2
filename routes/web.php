<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

// HOMEPAGE
Route::get('/', [HomeController::class, 'index'])->name('home');

// Formulário de login
Route::get('login',    [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login',   [AuthController::class, 'login']);

// Formulário de registo
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register',[AuthController::class, 'register']);

// Logout
Route::post('logout',  [AuthController::class, 'logout'])->name('logout');

// Listagem de users
Route::middleware('auth')->group(function(){
    Route::get('/users',            [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create',     [UserController::class, 'create'])->name('users.create');
    Route::post('/users',           [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}',     [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit',[UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}',     [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}',  [UserController::class, 'destroy'])->name('users.destroy');
});