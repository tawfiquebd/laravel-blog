<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Backend
Route::get('/dashboard', function() {
    return view('backend.dashboard');
});

Route::get('/categories', function() {
    return view('backend.categories');
});
