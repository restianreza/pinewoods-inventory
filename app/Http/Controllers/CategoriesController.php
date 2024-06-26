<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{

    public function index()
    {
        $categories = Categorie::all();

        return view('pages.more.categories', compact("categories"));
    }
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "category_name" => "required"
        ]);

        if ($validate->fails()) {
            $errors = $validate->errors()->all();
            return redirect()->back()->with('errors', $errors);
        };
        $category = new Categorie();
        $category->category_name = $request->category_name;
        $category->save();

        return redirect()->back()->with('success', "Category $category->category_name Berhasil Di Tambahkan");
    }
}
