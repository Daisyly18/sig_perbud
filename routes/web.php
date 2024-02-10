<?php

use App\Http\Controllers\AquacultureController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::resource('/aquaculture', AquacultureController::class)->names('aquaculture');


// Route::get('/aquaculture', function () {
//     return view ('pages.aquaculture.index');
// });
// Route::get('/aquaculture/create', function () {
//     return view ('pages.aquaculture.create');
// });
// Route::get('/aquaculture/edit', function () {
//     return view ('pages.aquaculture.edit');
// });

// Route::get('/pondsProgress', function () {
//     return view ('pages.pondsProgress.index');
// });

