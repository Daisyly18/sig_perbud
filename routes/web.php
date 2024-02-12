<?php

use App\Http\Controllers\AquacultureController;
use App\Http\Controllers\PondsProgressController;
use App\Models\PondsProgress;
use Illuminate\Support\Facades\Route;

Route::get('/',function () {return view('home'); })->name('home');
Route::get('/map',function () {return view('map'); })->name('map');
Route::get('/auth/login', function () {return view('auth.login'); })->name('login');

Route::resource('/aquaculture', AquacultureController::class)->names('aquaculture');
Route::resource('/pondsProgress', PondsProgressController::class)->names('pondsProgress');
Route::get('/tambak/{number}', [PondsProgressController::class, 'show']);



// Route::get('/pondsProgress', function () {
//     return view ('pages.pondsProgress.index');
// });

