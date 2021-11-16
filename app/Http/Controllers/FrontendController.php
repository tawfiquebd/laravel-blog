<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class FrontendController extends Controller
{
    // Home page view
    public function index() {
        $blogs = Blog::where('active', 1)->paginate(3);
        return view('frontend.blog', compact('blogs'));
    }



}
