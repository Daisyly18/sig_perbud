<?php

use App\Http\Controllers\AquacultureController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/map', function () {
    return view('map');
})->name('map');

Route::get('/auth/login', function () {
    return view('auth.login');   
})->name('login');


Route::resource('/aquaculture', AquacultureController::class)->names('aquaculture');


// Route::get('/pondsProgress', function () {
//     return view ('pages.pondsProgress.index');
// });

