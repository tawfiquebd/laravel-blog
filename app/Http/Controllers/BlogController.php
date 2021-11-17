<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Blog;
use Str;
use Yajra\DataTables\DataTables;
use Response;

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

//    Get all blogs
    public function getAllBlogs() {
        $blogs = Blog::all();

        return Datatables::of($blogs)
            ->editColumn('user_id', function ($blog) {
                return "<span class='badge badge-success badge-pill'>".$blog->user->name."</span>";
            })
            ->editColumn('category_id', function ($blog) {
                return "<span class='badge badge-dark badge-pill'>".$blog->category->name."</span>";
            })
//            ->addColumn('id', function (Blog $blog) {
//                return $blog->tags->map(function($tag) {
//                    return "<span class='badge badge-info badge-pill'>".$tag->name."</span>";
//                })->implode('&nbsp;');
//            })
            ->editColumn('short_description', function ($blog) {
                return Str::words($blog->short_description, 4, '...');
            })
            ->editColumn('active', function ($blog) {
                if($blog->active == 1) {
                    return "<span class='badge badge-success badge-pill'>". "Active" ."</span>";
                }
                else{
                    return "<span class='badge badge-dark badge-pill'>". "Waiting Approval" ."</span>";
                }
            })
            ->editColumn('description', function ($blog) {
                return Str::words($blog->description, 6, '...');
            })
            ->rawColumns(['user_id', 'category_id', 'id', 'description', 'active'])
            ->make(true);

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

        return redirect()->back()->with('success', 'Successful.');
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

    // Return Edit blog view
    public function editBlogView($id) {
        $blog = Blog::find($id);
        if($blog) {
            $categories = Category::all();
            $tags = Tag::all();

            return view('backend.editBlog', compact('categories', 'tags', 'blog'));
        }
        else {
            return abort(404);
        }
    }

    // Update blog
    public function updateBlog(Request $request) {
        $blog = Blog::findOrFail($request->blog_id);

        $this->updateBlogValidation($request);

        $active = $request->active == 'on' ? 1 : 0;

        $storeImage = $blog->image; // old image from db

        // if user upload a new image
        if($request->has('image')) {
            $path = "/images/blogImages/";
            $image = $blog->image;
            $this->deleteImage($path, $image);

            $uploadedImage = $request->file('image');
            $imageWithExt = $uploadedImage->getClientOriginalName();
            $imageName = pathinfo($imageWithExt, PATHINFO_FILENAME);
            $imageExt = $uploadedImage->getClientOriginalExtension();
            $storeImage = $imageName . time() . "." .$imageExt;
            $request->image->move(public_path('/images/blogImages'), $storeImage);
        }

        $blog->title = $request->title;
        $blog->url = $request->url;
        $blog->category_id = $request->category;
        $blog->image = $storeImage;
        $blog->image_alt = $request->image_alt;
        $blog->meta = $request->meta;
        $blog->short_description = $request->short_description;
        $blog->description = $request->description;
        $blog->active = $active;

        $blog->save();
        $blog->tags()->sync($request->tags);
        return redirect()->back()->with('success', 'Successful');
    }

    // Update blog validation
    public function updateBlogValidation($request) {
        if($request->has('image')) {

            $request->validate([
                'title' => 'required|min:3|max:255',
                'url' => 'required|min:3|max:255|unique:blogs,url,'.$request->blog_id,
                'category' => 'required',
                'tags' => 'required',
                'image' => 'required|mimes:jpeg,jpg,png,bmp,gif|max:2000',
                'image_alt' => 'required|min:3|max:255',
                'meta' => 'required|min:3|max:255',
                'short_description' => 'required|min:3|max:500',
                'description' => 'required|min:10',
            ]);

        }
        else {
            $request->validate([
                'title' => 'required|min:3|max:255',
                'url' => 'required|min:3|max:255|unique:blogs,url,'.$request->blog_id,
                'category' => 'required',
                'tags' => 'required',
                'image_alt' => 'required|min:3|max:255',
                'meta' => 'required|min:3|max:255',
                'short_description' => 'required|min:3|max:500',
                'description' => 'required|min:10',
            ]);
        }
        return $request;
    }

    // Delete image
    public function deleteImage($path, $image) {
        if(file_exists(public_path().$path.$image)) {
            unlink(public_path().$path.$image);
        }
    }

    // Delete blog post
    public function deleteBlog($id) {
        $blog = Blog::findOrFail($id);

        if($blog) {
            $path = '/images/blogImages/';
            $image = $blog->image;
            $this->deleteImage($path, $image);
            $blog->delete();

            return "Success";
        }
        else {
            return Response::json(['error' => 'Not Found'], 404);
        }
    }

    // Awaiting Approval Blade
    public function awaitingApproval() {
        return view('backend.awaiting');
    }

    // Get All Awaiting Approval Blogs
    public function getAwaitingApprovalBlogs() {
        $blogs = Blog::where('active',0)->get();

        return Datatables::of($blogs)
            ->editColumn('user_id', function ($blog) {
                return "<span class='badge badge-success badge-pill'>".$blog->user->name."</span>";
            })
            ->editColumn('category_id', function ($blog) {
                return "<span class='badge badge-dark badge-pill'>".$blog->category->name."</span>";
            })
            ->editColumn('short_description', function ($blog) {
                return Str::words($blog->short_description, 4, '...');
            })
            ->editColumn('active', function ($blog) {
                if($blog->active == 1) {
                    return "<span class='badge badge-success badge-pill'>". "Active" ."</span>";
                }
                else{
                    return "<span class='badge badge-dark badge-pill'>". "Waiting Approval" ."</span>";
                }
            })
            ->editColumn('description', function ($blog) {
                return Str::words($blog->description, 6, '...');
            })
            ->rawColumns(['user_id', 'category_id', 'id', 'description', 'active'])
            ->make(true);
    }

    // Approve User Blog
    public function approveBlog($id) {
        $blog = Blog::where('id', $id)->first();

        if($blog) {
            $blog->active = 1;
            $blog->save();
            return "Success";
        }
        else {
            return Response::json(['error'=>'Not Found'], 404);
        }

    }

    // User Awaiting Blogs View
    public function userAwaitingBlogs() {
        return view('userpanel.awaiting');
    }

    // User Related Specific Blogs (Awaiting Blogs)
    public function getAwaitingUserBlogs() {

        $user_id = Auth::user()->id;
        $blogs = Blog::where('user_id', $user_id)->where('active', 0)->get();

        return Datatables::of($blogs)
            ->editColumn('user_id', function ($blog) {
                return "<span class='badge badge-success badge-pill'>".$blog->user->name."</span>";
            })
            ->editColumn('category_id', function ($blog) {
                return "<span class='badge badge-dark badge-pill'>".$blog->category->name."</span>";
            })
            ->editColumn('short_description', function ($blog) {
                return Str::words($blog->short_description, 4, '...');
            })
            ->editColumn('active', function ($blog) {
                if($blog->active == 1) {
                    return "<span class='badge badge-success badge-pill'>". "Active" ."</span>";
                }
                else{
                    return "<span class='badge badge-dark badge-pill'>". "Waiting Approval" ."</span>";
                }
            })
            ->editColumn('description', function ($blog) {
                return Str::words($blog->description, 6, '...');
            })
            ->rawColumns(['user_id', 'category_id', 'id', 'description', 'active'])
            ->make(true);
    }

    // Return Edit blog view for user
    public function editBlogViewUser($id) {
        $blog = Blog::find($id);

        if($blog && $blog->user->id == Auth::user()->id){
            $categories = Category::all();
            $tags = Tag::all();

            return view('userpanel.editBlog', compact('categories', 'tags', 'blog'));
        }
        else{
            return abort(404);
        }

    }

    // User Approved Blogs View
    public function approvedBlogs() {
        return view('userpanel.approvedBlogs');
    }

    // Get User Approved Blogs List
    public function getUserApprovedBlogs() {
        $user_id = Auth::user()->id;
        $blogs = Blog::where('user_id', $user_id)->where('active', 1)->get();

        return Datatables::of($blogs)
            ->editColumn('user_id', function ($blog) {
                return "<span class='badge badge-success badge-pill'>".$blog->user->name."</span>";
            })
            ->editColumn('category_id', function ($blog) {
                return "<span class='badge badge-dark badge-pill'>".$blog->category->name."</span>";
            })
            ->editColumn('short_description', function ($blog) {
                return Str::words($blog->short_description, 4, '...');
            })
            ->editColumn('active', function ($blog) {
                if($blog->active == 1) {
                    return "<span class='badge badge-success badge-pill'>". "Active" ."</span>";
                }
                else{
                    return "<span class='badge badge-dark badge-pill'>". "Waiting Approval" ."</span>";
                }
            })
            ->editColumn('description', function ($blog) {
                return Str::words($blog->description, 6, '...');
            })
            ->rawColumns(['user_id', 'category_id', 'id', 'description', 'active'])
            ->make(true);
    }

}
