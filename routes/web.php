<?php

use App\Http\Controllers\AquacultureController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PondsProgressController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



Route::get('/',function () {return view('home'); })->name('home');
Route::get('/map', function () {return view('map'); })->name('map');
Route::get('/fetch/poligon', [AquacultureController::class, 'map']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'auth_login'])->name('auth.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');  
  

Route::middleware('auth')->group(function () {
    Route::resource('/dashboard', DashboardController::class)->names('dashboard');    
    Route::resource('/aquaculture', AquacultureController::class)->names('aquaculture');
    Route::resource('/pondsProgress', PondsProgressController::class)->names('pondsProgress'); 
    Route::resource('/user', UserController::class)->names('user');    
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.edit');
    Route::put('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');

});






