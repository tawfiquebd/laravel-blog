<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
//    Return Blogs listing view
    public function index() {
        return view('backend.blogs');
    }

//    Return create blog view
    public function createBlogView() {
        return view('backend.createBlog');
    }

}
