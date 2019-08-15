<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller {

    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index-categories', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create-categories');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $category = $request->all();

        $category['displays_in_menu'] = $request->has('displays_in_menu') ? true : false;
        $category['active']           = $request->has('active') ? true : false;

        Category::create($category);

        return redirect('/categories');
    }

    public function show(Category $category)
    {
        return view('admin.categories.show-categories', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit-categories', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $category = $request->all();

        $category['displays_in_menu'] = $request->has('displays_in_menu') ? true : false;
        $category['active']           = $request->has('active') ? true : false;

        Category::update($category);

        return redirect('/categories');
    }

    public function destroy(Category $category)
    {
        //
    }
}
