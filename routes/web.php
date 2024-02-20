<?php

use App\Http\Controllers\AquacultureController;
use App\Http\Controllers\Backend\DataController;
use Illuminate\Support\Facades\Route;

Route::get('/',function () {return view('home'); })->name('home');
Route::get('/map',function () {return view('map'); })->name('map');
Route::get('/auth/login', function () {return view('auth.login'); })->name('login');

Route::resource('/aquaculture', AquacultureController::class)->names('aquaculture');




// Route::get('/spot/data',[DataController::class,'spot'])->name('spot.data');

// Route::resource('/pondsProgress', PondsProgressController::class)->names('pondsProgress');
// Route::get('/tambak/{number}', [PondsProgressController::class, 'show']);
// Route::get('/pondsProgress', function () {
//     return view ('pages.pondsProgress.index');
// });

