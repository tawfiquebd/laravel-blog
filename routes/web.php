<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;


//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Frontend
Route::get('/', function() {
    return view('frontend.blog');
});

Route::get('/about', function() {
    return view('frontend.about');
});

Route::get('/contact', function() {
    return view('frontend.contact');
});

Route::get('/blog-details', function() {
    return view('frontend.blog-details');
});


// Backend
Route::group(['middleware' => 'auth'], function() {

    Route::get('/dashboard', function() {
        return view('backend.dashboard');
    });

    Route::get('/categories', [CategoryController::class, 'index']);
});

