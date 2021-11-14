<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Datatables;
use Carbon\Carbon;

class CategoryController extends Controller
{

    // return view for categories
    public function index() {
        return view('backend.categories');
    }

    // Getting all the categories using Datatables
    public function getAllCategories() {
        $categories = Category::all();

        return Datatables::of($categories)
            ->editColumn('created_at', function ($category) {
                return $category->created_at ? with(new Carbon($category->created_at))->format('d-M-Y') : '';
            })
            ->editColumn('updated_at', function ($category) {
                return $category->updated_at ? with(new Carbon($category->updated_at))->format('d-M-Y') : '';
            })
            ->make(true);
    }

    // create category
    public function create(Request $request) {
        $request->validate([
           'category_name' => 'required|min:3|max:255',
        ]);

        $slug = Str::slug($request->category_name);

        $category = Category::create([
            'name' => $request->category_name,
            'slug' => $slug,
        ]);

        return "Success";

    }

}
