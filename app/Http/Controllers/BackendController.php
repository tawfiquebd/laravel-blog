<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Cms;
use App\Models\Message;
use App\Models\Tag;
use App\Models\User;
use App\Models\Blog;
use Auth;
use Response;
use Str;
use Illuminate\Http\Request;
use Yajra\DataTables\Datatables;
use Carbon\Carbon;
use App\Models\Role;
use App\Traits\MyTrait;
use Hash;

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

    // Profile settings for Admins and Basic Users
    public function profile() {
        $user = Auth::user();

        return view('backend.profile', compact('user'));
    }

    // Update username or profile
    public function updateProfile(Request $request) {
        $authUser = Auth::user();

        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$authUser->id],
        ]);

        $authUser->name = $request->username;
        $authUser->email = $request->email;
        $authUser->update();

        return redirect()->back()->with('success', 'Successful');
    }

    // Update user password
    public function updatePassword(Request $request) {
        $authUser = Auth::user();

        $request->validate([
            'old_password' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required'],
        ]);

        if(Hash::check($request->old_password, $authUser->password)) {
            $authUser->password = Hash::make($request->password);
            $authUser->update();
            return redirect()->back()->with('success', 'Successful');
        }
        else {
            return redirect()->back()->with('error', 'Old password does not match.');
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

    // Return contact Messages view
    public function contactMsgView() {
        return view('backend.messages');
    }

    // Return all contact messages
    public function getAllMessage() {
        $messages = Message::latest()->get();

        return Datatables::of($messages)
            ->editColumn('message', function ($message) {
                return Str::words($message->message, 15, '...');
            })
            ->editColumn('created_at', function ($message) {
                return $message->created_at ? with(new Carbon($message->created_at))->format('d-M-Y') : '';
            })
            ->editColumn('updated_at', function ($message) {
                return $message->updated_at ? with(new Carbon($message->updated_at))->format('d-M-Y') : '';
            })
            ->make(true);
    }

    // Get specific contact message
    public function getMessage($id) {
        $msg = Message::findOrFail($id);

        if($msg) {
            return $msg;
        }
        else {
            return Response::json(['error' => 'Message not found'], 404);
        }
    }

    // Delete specific contact message
    public function deleteMessage($id) {
        $msg = Message::findOrFail($id);

        if($msg) {
            $msg->delete();
            return "Success";
        }
        else {
            return Response::json(['error' => 'Message not found'], 404);
        }
    }

}

