<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class FrontendController extends Controller
{
    // Home page view
    public function index() {
        $blogs = Blog::where('active', 1)->latest()->paginate(3);
        return view('frontend.blog', compact('blogs'));
    }

    // Blog details page
    public function blogDetails($url) {
        $blog = Blog::where('url', $url)->first();

        return view('frontend.blog-details', compact('blog'));
    }

}
