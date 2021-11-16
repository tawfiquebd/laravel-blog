<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class BackendController extends Controller
{
    // User Dashboard
    public function userDashboard() {
        return view('userpanel.dashboard');
    }

    // Create blog post
    public function createBlog() {
        $categories = Category::all();
        $tags = Tag::all();

        return view('userpanel.createBlog', compact('categories', 'tags'));
    }

}
