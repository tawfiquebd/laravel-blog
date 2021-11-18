<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Cms;
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
        $about_section = Cms::where('section_name', 'about_section')->first();
        return view('backend.cms', compact('about_section'));
    }

    // Create or Update About
    public function createOrUpdateAbout(Request $request) {
        $request->validate([
            'about_heading' => 'required|min:3|max:255',
            'about_short_description' => 'required|min:3|max:255',
            'about_description' => 'required|min:3'
        ]);

        if(empty($request->about_section_name)) {
            $about = Cms::create([
                'section_name' => "about_section",
                'about_heading' => $request->about_heading,
                'about_short_description' => $request->about_short_description,
                'about_description' => $request->about_description
            ]);
            $msg = 'created';
            return compact('msg', 'about');
        }
        else {
            $about = Cms::where('section_name', 'about_section')->first();
            $about->about_heading = $request->about_heading;
            $about->about_short_description = $request->about_short_description;
            $about->about_description = $request->about_description;
            $about->save();
            $msg = 'updated';
            return compact('msg', 'about');
        }


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
