<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::paginate(10);

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
        $category['featured'] = $request->has('featured') ? true : false;
        $category['active'] = $request->has('active') ? true : false;

        Category::create($category);

        return redirect(route('categories.index'))
            ->with('success', trans('admin.created_successfully', [
                'object' => trans('admin.category')
            ]));
    }

    public function show(Category $category)
    {
        return view('admin.categories.show-categories', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit-categories', compact('category'));
    }

    public function update(Category $category)
    {
        \request()->validate([
            'name' => 'required'
        ]);

        $aux_category = \request()->all();

        $aux_category['displays_in_menu'] = \request()->has('displays_in_menu') ? true : false;
        $aux_category['featured'] = \request()->has('featured') ? true : false;
        $aux_category['active'] = \request()->has('active') ? true : false;

        $category->update($aux_category);

        return redirect(route('categories.index'))
            ->with('success', trans('admin.updated_successfully', [
                'object' => trans('admin.category')
            ]));
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect(route('categories.index'))
            ->with('success', trans('admin.deleted_successfully', [
                'object' => trans('admin.category')
            ]));
    }
}
