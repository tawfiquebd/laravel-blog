<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Cms;
use App\Models\Tag;
use App\Models\User;
use App\Models\Blog;
use Auth;
use Response;
use Illuminate\Http\Request;
use Yajra\DataTables\Datatables;
use Carbon\Carbon;
use App\Models\Role;
use App\Traits\MyTrait;

class BackendController extends Controller
{
    use MyTrait;

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

    // Return All users of system view
    public function allUsersView() {
        return view('backend.users');
    }

    // Return All users of our system
    public function getAllUsers() {
//        $users = User::all();
        $users = Role::where('id', 2)->first()->users()->get(); // get all basic-user role uesr

        return Datatables::of($users)
            ->editColumn('created_at', function ($user) {
                return $user->created_at ? with(new Carbon($user->created_at))->format('d-M-Y') : '';
            })
            ->editColumn('updated_at', function ($user) {
                return $user->updated_at ? with(new Carbon($user->updated_at))->format('d-M-Y') : '';
            })
            ->make(true);
    }

    // Delete specific user and the related records
    public function deleteUser($id) {
        $user = User::findOrFail($id);

        if($user) {
            $path = "/images/blogImages/";

            foreach ($user->blogs as $blog) {
                $image = $blog->image;
                $this->deleteImage($path, $image);  // common method calling here from trait
            }

            $user->delete();

            return "Success";
        }
        else {
            return Response::json(['error' => 'Not found'], 404);
        }

    }

    // CMS view
    public function cms() {
        $about_section = Cms::where('section_name', 'about_section')->first();
        $contact_section = Cms::where('section_name', 'contact_section')->first();
        $footer_section = Cms::where('section_name', 'footer_section')->first();
        return view('backend.cms', compact('about_section', 'contact_section', 'footer_section'));
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

    // Create or Update Contact
    public function createOrUpdateContact(Request $request) {
        $request->validate([
            'contact_heading' => 'required|min:3|max:255',
            'contact_short_description' => 'required|min:3|max:255',
            'contact_description' => 'required|min:3'
        ]);

        if(empty($request->contact_section_name)) {
            $contact = Cms::create([
                'section_name' => "contact_section",
                'contact_heading' => $request->contact_heading,
                'contact_short_description' => $request->contact_short_description,
                'contact_description' => $request->contact_description
            ]);
            $msg = 'created';
            return compact('msg', 'contact');
        }
        else {
            $contact = Cms::where('section_name', 'contact_section')->first();
            $contact->contact_heading = $request->contact_heading;
            $contact->contact_short_description = $request->contact_short_description;
            $contact->contact_description = $request->contact_description;
            $contact->save();
            $msg = 'updated';
            return compact('msg', 'contact');
        }


    }

    // Create or Update Footer
    public function createOrUpdateFooter(Request $request) {
        $request->validate([
            'twitter' => 'required|min:3|max:255',
            'facebook' => 'required|min:3|max:255',
            'instagram' => 'required|min:3|max:255'
        ]);

        if(empty($request->footer_section_name)) {
            $footer = Cms::create([
                'section_name' => "footer_section",
                'twitter' => $request->twitter,
                'facebook' => $request->facebook,
                'instagram' => $request->instagram
            ]);
            $msg = 'created';
            return compact('msg', 'footer');
        }
        else {
            $footer = Cms::where('section_name', 'footer_section')->first();
            $footer->twitter = $request->twitter;
            $footer->facebook = $request->facebook;
            $footer->instagram = $request->instagram;
            $footer->save();
            $msg = 'updated';
            return compact('msg', 'footer');
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
