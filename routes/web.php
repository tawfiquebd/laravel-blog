<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\BlogController;
use App\Models\User;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;

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

    // Category Crud
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/add-category', [CategoryController::class, 'create']);
    Route::get('/getAllCategories', [CategoryController::class, 'getAllCategories']);
    Route::get('/getCategory/{id}', [CategoryController::class, 'getCategory']);
    Route::post('/updateCategory', [CategoryController::class, 'updateCategory']);
    Route::post('/deleteCategory/{id}', [CategoryController::class, 'deleteCategory']);

    // Tag Crud
    Route::get('/tags', [TagController::class, 'index']);
    Route::post('/addTag', [TagController::class, 'create']);
    Route::post('/getAllTags', [TagController::class, 'getAllTags']);
    Route::get('/getTag/{id}', [TagController::class, 'getTag']);
    Route::post('/updateTag', [TagController::class, 'updateTag']);
    Route::post('/deleteTag/{id}', [TagController::class, 'deleteTag']);

    // Blog Crud
    Route::get('/blogs', [BlogController::class, 'index']);
    Route::get('/createBlog', [BlogController::class, 'createBlogView']);
    Route::post('/blogCreate', [BlogController::class, 'create']);

});

