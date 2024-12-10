<?php

namespace App\Http\Controllers;

use App\Models\PizzaCategory;
use Illuminate\Http\Request;

class PizzaCategoryController extends Controller
{
    public function index()
    {
        $categories = PizzaCategory::get();
        return view('admin.category.index', compact('categories'));
    }

    public function create(Request $request)
    {
        $this->checkValidation($request);
        PizzaCategory::updateOrCreate([
            'name' => $request->category
        ]);
        return back();
    }

    public function editPage($id)
    {
        $category = PizzaCategory::where('id', $id)->first();
        return view('admin.category.update', compact("category"));
    }

    public function edit(Request $request)
    {
        $this->checkValidation($request);

        PizzaCategory::where('id', $request->categoryID)->update([
            'name' => $request->category
        ]);
        return to_route('admin#categories');
    }

    private function checkValidation($request)
    {
        $request->validate([
            'category' => 'required'
        ]);
    }
}
