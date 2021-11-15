<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Blog;

class BlogController extends Controller
{
//    Return Blogs listing view
    public function index() {
        return view('backend.blogs');
    }

//    Return create blog view
    public function createBlogView() {
        $categories = Category::all();
        $tags = Tag::all();

        return view('backend.createBlog', compact('categories', 'tags'));
    }


//    Create blog
    public function create(Request $request) {
        $user = Auth::user();

        $active = $request->active == 'on' ? '1' : '0';

        $this->validateBlog($request);

        $uploadedImage = $request->file('image');
        $imageWithExt = $uploadedImage->getClientOriginalName();
        $imageName = pathinfo($imageWithExt, PATHINFO_FILENAME);
        $imageExt = $uploadedImage->getClientOriginalExtension();
        $image = $imageName . time() . "." .$imageExt;
        $request->image->move(public_path('/images/blogImages'), $image);

        $blog = Blog::create([
            'user_id' => $user->id,
            'category_id' => $request->category,
            'title' => $request->title,
            'url' => $request->url,
            'image' => $image,
            'image_alt' => $request->image_alt,
            'meta' => $request->meta,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'active' => $active,
        ]);

        $blog->tags()->attach($request->tags);

        return redirect()->back()->with('success', 'Successfull.');
    }

    public function validateBlog($request) {
        $request->validate([
            'title' => 'required|min:3|max:255',
            'url' => 'required|min:3|max:255|unique:blogs',
            'category' => 'required',
            'tags' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png,bmp,gif|max:2000',
            'image_alt' => 'required|min:3|max:255',
            'meta' => 'required|min:3|max:255',
            'short_description' => 'required|min:3|max:500',
            'description' => 'required|min:10',
        ]);

        return $request;
    }

}
