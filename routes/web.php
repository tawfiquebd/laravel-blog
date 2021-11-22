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
Route::post('/search-blog', [FrontendController::class, 'search']);
Route::get('/category/{slug}', [FrontendController::class, 'filterCategory']);
Route::get('/tag/{slug}', [FrontendController::class, 'filterTag']);
Route::get('/blog/{url}', [FrontendController::class, 'blogDetails']);
Route::get('/about-us', [FrontendController::class, 'aboutUs']);
Route::get('/contact-us', [FrontendController::class, 'contactUs']);
Route::post('/createContactMessage', [FrontendController::class, 'createContactMessage']);


// Backend
Route::group(['middleware' => 'auth'], function() {

    // User Dashboard
    Route::get('/user/dashboard', [BackendController::class, 'userDashboard']);
    Route::get('/user/createBlog', [BackendController::class, 'createBlog']);
    Route::post('/user/create', [BlogController::class, 'create']);

    // User awaiting blogs
    Route::get('/user/awaitingBlogs', [BlogController::class, 'userAwaitingBlogs']);
    Route::post('/user/getAwaitingUserBlogs', [BlogController::class, 'getAwaitingUserBlogs']);
    Route::get('/user/editBlog/{id}', [BlogController::class, 'editBlogViewUser']);
    Route::post('/user/blogUpdate', [BlogController::class, 'updateBlog']);
    Route::post('/user/deleteBlog/{id}', [BlogController::class, 'deleteBlog']);
    Route::get('/user/approvedBlogs', [BlogController::class, 'approvedBlogs']);
    Route::post('/user/getUserApprovedBlogs', [BlogController::class, 'getUserApprovedBlogs']);

    // Profile settings for Admin and Basic users
    Route::get('/settings/profile', [BackendController::class, 'profile']);

    Route::group(['middleware' => 'checkrole'], function () {

        Route::get('/dashboard', [BackendController::class, 'dashboard']);
        Route::get('/all/users', [BackendController::class, 'allUsersView']);
        Route::post('/getAllUsers', [BackendController::class, 'getAllUsers']);
        Route::get('/deleteUser/{id}', [BackendController::class, 'deleteUser']);
        Route::get('/cms', [BackendController::class, 'cms']);
        Route::post('/createOrUpdateAbout', [BackendController::class, 'createOrUpdateAbout']);
        Route::post('/createOrUpdateContact', [BackendController::class, 'createOrUpdateContact']);
        Route::post('/createOrUpdateFooter', [BackendController::class, 'createOrUpdateFooter']);

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

        // Contact Messages Route
        Route::get('/contact-message', [BackendController::class, 'contactMsgView']);
        Route::post('/getAllMessage', [BackendController::class, 'getAllMessage']);
        Route::get('/getMessage/{id}', [BackendController::class, 'getMessage']);
        Route::post('/deleteMessage/{id}', [BackendController::class, 'deleteMessage']);

    });

});

