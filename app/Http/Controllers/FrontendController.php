<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Cms;

class FrontendController extends Controller
{
    // Home page view
    public function index() {
        $blogs = Blog::where('active', 1)->latest()->paginate(3);

        $links = Cms::where('section_name', 'footer_section')->first();
        return view('frontend.blog', compact('blogs', 'links'));
    }

    // Blog details page
    public function blogDetails($url) {
        $blog = Blog::where('url', $url)->first();

        $links = Cms::where('section_name', 'footer_section')->first();
        return view('frontend.blog-details', compact('blog', 'links'));
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


}
