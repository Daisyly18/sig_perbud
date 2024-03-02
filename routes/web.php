<?php

use App\Http\Controllers\AquacultureController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PondsProgressController;
use App\Http\Controllers\Backend\DataController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;



Route::get('/',function () {return view('home'); })->name('home');
Route::get('/map', function () {return view('map'); })->name('map');
Route::get('/fetch/poligon', [AquacultureController::class, 'map']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'auth_login'])->name('auth.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');    

Route::middleware('web', 'auth')->group(function () {
    Route::resource('/dashboard', DashboardController::class)->names('dashboard');    
    Route::resource('/aquaculture', AquacultureController::class)->names('aquaculture');
    Route::resource('/pondsProgress', PondsProgressController::class)->names('pondsProgress'); 

});


// Route::get('login', function () {return view('auth.login'); })->name('login');



