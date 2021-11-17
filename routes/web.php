<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\BlogController;
use App\Models\User;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Role;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\BackendController;

//Route::get('/', function () {
//    return view('welcome');
//});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Frontend
Route::get('/', [FrontendController::class, 'index']);
Route::get('/blog/{url}', [FrontendController::class, 'blogDetails']);

Route::get('/about', function() {
    return view('frontend.about');
});

Route::get('/contact', function() {
    return view('frontend.contact');
});




// Backend
Route::group(['middleware' => 'auth'], function() {

    // User Dashboard
    Route::get('/user/dashboard', [BackendController::class, 'userDashboard']);
    Route::get('/user/createBlog', [BackendController::class, 'createBlog']);
    Route::post('/user/create', [BlogController::class, 'create']);

    // User awaiting blogs
    Route::get('/user/awaitingBlogs', [BlogController::class, 'userAwaitingBlogs']);
    Route::post('/user/getAwaitingUserBlogs', [BlogController::class, 'getAwaitingUserBlogs']);
    Route::post('/user/deleteBlog/{id}', [BlogController::class, 'deleteBlog']);

    Route::group(['middleware' => 'checkrole'], function () {

        Route::get('/dashboard', function () {
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
        Route::post('/getAllBlogs', [BlogController::class, 'getAllBlogs']);
        Route::get('/editBlog/{id}', [BlogController::class, 'editBlogView']);
        Route::post('/blogUpdate', [BlogController::class, 'updateBlog']);
        Route::post('/deleteBlog/{id}', [BlogController::class, 'deleteBlog']);

        // Awaiting Approval Blogs Admin
        Route::get('/awaitingApproval', [BlogController::class, 'awaitingApproval']);
        Route::post('/getAwaitingApprovalBlogs', [BlogController::class, 'getAwaitingApprovalBlogs']);
        Route::post('/approveBlog/{id}', [BlogController::class, 'approveBlog']);


    });

});

