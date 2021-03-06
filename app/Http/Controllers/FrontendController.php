<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use App\Models\Visitor;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Cms;
use App\Models\Message;
use Illuminate\Support\Str;

class FrontendController extends Controller
{
    // Home page view
    public function index() {
        $blogs = Blog::where('active', 1)->latest()->paginate(6);

        $popularBlogs = Visitor::selectRaw('blog_id, count(id) as count')
            ->groupBy('blog_id')
            ->orderBy('blog_id', 'desc')
            ->limit(5)
            ->get();

        $allBlogs = Blog::orderBy('id', 'desc')->get();

        $links = Cms::where('section_name', 'footer_section')->first();

        $categories = Category::all();

        $tags = Tag::all();

        return view('frontend.blog', compact('blogs', 'links', 'categories', 'tags', 'popularBlogs', 'allBlogs'));
    }

    // Blog details page
    public function blogDetails(Request  $request, $url) {
        $blog = Blog::where('url', $url)->first();

        $ip = $request->ip();

        if($blog) {
            $this->insertUniqueView($ip, $blog);

            $views = Visitor::where('blog_id', $blog->id)->count();

            $links = Cms::where('section_name', 'footer_section')->first();
            return view('frontend.blog-details', compact('blog', 'links', 'views'));
        }
        else {
            return abort(404);
        }

    }

    // About us page view
    public function aboutUs() {
        $about = Cms::where('section_name', 'about_section')->first();

        $links = Cms::where('section_name', 'footer_section')->first();
        return view('frontend.about', compact('about', 'links'));
    }

    // Contact us page view
    public function contactUs() {
        $contact = Cms::where('section_name', 'contact_section')->first();

        $links = Cms::where('section_name', 'footer_section')->first();
        return view('frontend.contact', compact('contact', 'links'));
    }

    // Send contact message
    public function createContactMessage(Request $request) {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email',
            'message' => 'required|min:3',
        ]);

        $message = Message::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        return "Success";
    }

    // Filter Blogs by Category
    public function filterCategory($slug) {
        $findCategory = Category::where('slug', $slug)->first();

        if($findCategory) {
            $blogs = Blog::where('category_id', $findCategory->id)->where('active', 1)->latest()->paginate(6);

            $categoryName = $findCategory->name;

            $popularBlogs = Visitor::selectRaw('blog_id, count(id) as count')
                ->groupBy('blog_id')
                ->orderBy('blog_id', 'desc')
                ->limit(5)
                ->get();

            $allBlogs = Blog::orderBy('id', 'desc')->get();

            $links = Cms::where('section_name', 'footer_section')->first();

            $categories = Category::all();

            $tags = Tag::all();

            return view('frontend.blog', compact('blogs', 'links', 'categories', 'tags', 'categoryName', 'popularBlogs', 'allBlogs'));
        }
        else {
            abort(404);
        }
    }

    // Filter Blogs by Tags
    public function filterTag($slug) {
        $findTag = Tag::where('slug', $slug)->first();

        if($findTag) {
            $blogs = Blog::whereHas('tags', function($q) use ($slug) {
                $q->where('slug', $slug);
            })->where('active', 1)->latest()->paginate(6);

            $tagName = $findTag->name;

            $popularBlogs = Visitor::selectRaw('blog_id, count(id) as count')
                ->groupBy('blog_id')
                ->orderBy('blog_id', 'desc')
                ->limit(5)
                ->get();

            $allBlogs = Blog::orderBy('id', 'desc')->get();

            $links = Cms::where('section_name', 'footer_section')->first();

            $categories = Category::all();

            $tags = Tag::all();

            return view('frontend.blog', compact('blogs', 'links', 'categories', 'tags', 'tagName', 'popularBlogs', 'allBlogs'));
        }
        else {
            abort(404);
        }
    }

    // Search Blog
    public function search(Request $request) {
        $request->validate([
           'search' => 'required|min:3|max:255',
        ]);

        $search = $request->search;

        $blogs = Blog::select('*')
            ->orderBy('id', 'desc')
            ->where('title', 'like' , '%'.$search.'%')
            ->orWhere('short_description', 'like' , '%'.$search.'%')
            ->orWhere('description', 'like' , '%'.$search.'%')
            ->paginate(6);

        $popularBlogs = Visitor::selectRaw('blog_id, count(id) as count')
            ->groupBy('blog_id')
            ->orderBy('blog_id', 'desc')
            ->limit(5)
            ->get();

        $allBlogs = Blog::orderBy('id', 'desc')->get();

        $links = Cms::where('section_name', 'footer_section')->first();

        $categories = Category::all();

        $tags = Tag::all();

        return view('frontend.blog', compact('blogs', 'links', 'categories', 'tags', 'search', 'popularBlogs', 'allBlogs'));
    }

    // Insert unique views for blog
    public function insertUniqueView($ip, $blog) {
        $checkVisitor = Visitor::where('blog_id', $blog->id)->where('ip', $ip)->get();

        if(count($checkVisitor) > 0) {
            return true;
        }
        else {
            $uniqueView = Visitor::create([
                'blog_id' => $blog->id,
                'ip' => $ip,
            ]);

            return true;
        }
    }

}
