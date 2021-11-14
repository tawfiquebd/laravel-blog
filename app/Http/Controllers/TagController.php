<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class TagController extends Controller
{

    // return view for tags
    public function index() {
        return view('backend.tags');
    }

    // Getting all the tags using Datatables
    public function getAllTags() {
        $tags = Tag::all();

        return Datatables::of($tags)
            ->editColumn('created_at', function ($tag) {
                return $tag->created_at ? with(new Carbon($tag->created_at))->format('d-M-Y') : '';
            })
            ->editColumn('updated_at', function ($tag) {
                return $tag->updated_at ? with(new Carbon($tag->updated_at))->format('d-M-Y') : '';
            })
            ->make(true);
    }

    // create tag
    public function create(Request $request) {
        $request->validate([
            'tag_name' => 'required|min:3|max:255',
        ]);

        $slug = Str::slug($request->tag_name);

        $tag = Tag::create([
            'name' => $request->tag_name,
            'slug' => $slug,
        ]);

        return "Success";

    }

    // Get Tag
    public function getTag($id) {
        $tag = Tag::find($id);
        if($tag){
            return $tag;
        }
        else {
            return Response::json(['error' => 'Not Found' ], 404);
        }
    }

    // Update tag
    public function updateTag(Request $request) {
        $request->validate([
            'edit_tag' => 'required|min:3|max:255',
        ],[
            // custom validation message
            'edit_tag.required' => 'This tag field is required.',
            'edit_tag.min' => 'This tag name should be minimum 3 characters.',
            'edit_tag.max' => 'This tag name may not be greater than 255 characters.',
        ]);

        $tag = Tag::find($request->tag_id);
        $tag->name = $request->edit_tag;
        $tag->slug = Str::slug($request->edit_tag);
        $tag->save();

        return "Success";
    }

    // Delete Tag
    public function deleteTag($id) {
        $tag = Tag::find($id);
        if($tag) {
            $tag->delete();
            return "Success";
        }
        else {
            return Response::json(['error' => 'Not Found'], 404);
        }
    }

}
