<?php

use App\Http\Controllers\AquacultureController;
use App\Http\Controllers\PondsProgressController;
use App\Http\Controllers\Backend\DataController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/',function () {return view('home'); })->name('home');
Route::get('/map', function () {return view('map'); })->name('map');
Route::get('/fetch/poligon', [AquacultureController::class, 'map']);

Route::resource('/aquaculture', AquacultureController::class)->names('aquaculture');
Route::resource('/pondsProgress', PondsProgressController::class)->names('pondsProgress'); 
Route::resource('/dashboard', DashboardController::class)->names('dashboard');


Route::get('/auth/login', function () {return view('auth.login'); })->name('login');

// Route::put('/aquacultures/{aquaculture}/update', [PondsProgressController::class, 'update'])->name('aquacultures.update');





// Route::get('/spot/data',[DataController::class,'spot'])->name('spot.data');

// Route::get('/tambak/{number}', [PondsProgressController::class, 'show']);
// Route::get('/pondsProgress', function () {
//     return view ('pages.pondsProgress.index');
// });

