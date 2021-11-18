<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use App\Models\Blog;
use Auth;
use Illuminate\Http\Request;

class BackendController extends Controller
{

    // Admin Dashboard
    public function dashboard(){
        $categoriesCount = Category::count();
        $tagsCount = Tag::count();
        $blogsCount = Blog::count();
        $publishedBlogsCount = Blog::where('active', 1)->count();
        $awaitingBlogsCount = Blog::where('active', 0)->count();
        $usersCount = User::count();

        return view('backend.dashboard', compact('categoriesCount', 'tagsCount', 'blogsCount', 'publishedBlogsCount', 'awaitingBlogsCount', 'usersCount'));
    }

    // CMS view
    public function cms() {
        return view('backend.cms');
    }

    // User Dashboard
    public function userDashboard() {
        $user_id = Auth::user()->id;
        $blogsCount = Blog::where('user_id', $user_id)->count();
        $approvedBlogsCount = Blog::where('user_id', $user_id)->where('active', 1)->count();
        $awaitingBlogsCount = Blog::where('user_id', $user_id)->where('active', 0)->count();

        return view('userpanel.dashboard', compact('blogsCount', 'approvedBlogsCount', 'awaitingBlogsCount'));
    }

    // Create blog post
    public function createBlog() {
        $categories = Category::all();
        $tags = Tag::all();

        return view('userpanel.createBlog', compact('categories', 'tags'));
    }

}
