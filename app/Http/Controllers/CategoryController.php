<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends CustomController
{
    public function __construct(private CategoryService $service) {}

    public function index()
    {
        $categories = $this->service->index();

        return view('admin.categories.index-categories', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create-categories');
    }

    public function store(Request $request)
    {
        try {
            $this->service->store($request);
        } catch (\Throwable $th) {
            return $this->responseRoute(
                $this::ERROR,
                'categories.index',
                'admin.error_creating',
                'admin.category'
            );
        }

        return $this->responseRoute(
            $this::SUCCESS,
            'categories.index',
            'admin.created_successfully',
            'admin.category'
        );
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit-categories', compact('category'));
    }

    public function update(Category $category)
    {
        try {
            $this->service->update($category);
        } catch (\Throwable $th) {
            return $this->responseRoute(
                $this::ERROR,
                'categories.index',
                'admin.error_updating',
                'admin.category'
            );
        }

        return $this->responseRoute(
            $this::SUCCESS,
            'categories.index',
            'admin.updated_successfully',
            'admin.category'
        );
    }

    public function destroy(Category $category)
    {
        try {
            $this->service->destroy($category);
        } catch (\Throwable $th) {
            return $this->responseRoute(
                $this::ERROR,
                'categories.index',
                ['admin.error_deleting', $th->getMessage()],
                'admin.category'
            );
        }
    
        return $this->responseRoute(
            $this::SUCCESS,
            'categories.index',
            'admin.deleted_successfully',
            'admin.category'
        );
    }
}
