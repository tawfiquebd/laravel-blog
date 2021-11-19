<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Cms;
use App\Models\Message;
use Illuminate\Support\Str;

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

}
