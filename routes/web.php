<?php

use App\Http\Controllers\AquacultureController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
Route::get('/login', function () {
    return view('login');
});

Route::resource('/aquaculture', AquacultureController::class)->names('aquaculture');


// Route::get('/pondsProgress', function () {
//     return view ('pages.pondsProgress.index');
// });

