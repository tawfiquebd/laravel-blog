<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    // return view for categories
    public function index() {
        return view('backend.categories');
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
