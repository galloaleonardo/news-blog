<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;

class CategoryController extends CustomController
{
    const INDEX_ROUTE = 'categories.index';
    const OBJECT_MESSAGE = 'admin.category';

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

    public function store(CategoryRequest $request)
    {
        try {
            $data = $request->validated();

            $this->service->store($data);
        } catch (\Throwable $th) {
            return $this->responseRoute(
                $this::ERROR,
                $this::INDEX_ROUTE,
                $this::ERROR_CREATE_MESSAGE,
                $this::OBJECT_MESSAGE
            );
        }

        return $this->responseRoute(
            $this::SUCCESS,
            $this::INDEX_ROUTE,
            $this::SUCCESS_CREATE_MESSAGE,
            $this::OBJECT_MESSAGE
        );
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit-categories', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        try {
            $data = $request->validated();

            $this->service->update($category, $data);
        } catch (\Throwable $th) {
            return $this->responseRoute(
                $this::ERROR,
                $this::INDEX_ROUTE,
                $this::ERROR_UPDATE_MESSAGE,
                $this::OBJECT_MESSAGE
            );
        }

        return $this->responseRoute(
            $this::SUCCESS,
            $this::INDEX_ROUTE,
            $this::SUCCESS_UPDATE_MESSAGE,
            $this::OBJECT_MESSAGE
        );
    }

    public function destroy(Category $category)
    {
        try {
            $this->service->destroy($category);
        } catch (\Throwable $th) {
            return $this->responseRoute(
                $this::ERROR,
                $this::INDEX_ROUTE,
                [$this::ERROR_DELETE_MESSAGE, $th->getMessage()],
                $this::OBJECT_MESSAGE
            );
        }
    
        return $this->responseRoute(
            $this::SUCCESS,
            $this::INDEX_ROUTE,
            $this::SUCCESS_DELETE_MESSAGE,
            $this::OBJECT_MESSAGE
        );
    }
}
