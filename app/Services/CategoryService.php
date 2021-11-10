<?php

namespace App\Services;

use App\Models\Category;
use App\Models\News;
use App\Repositories\CategoryRepository;
use Exception;
use Illuminate\Http\Request;

class CategoryService
{
    public function __construct(private CategoryRepository $repository) {}

    public function index()
    {
        return $this->repository->index();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $data = $request->all();

        $data['displays_in_menu'] = $request->has('displays_in_menu') ? true : false;
        $data['featured'] = $request->has('featured') ? true : false;
        $data['active'] = $request->has('active') ? true : false;

        return $this->repository->store($data);
    }

    public function update(Category $category)
    {
        \request()->validate([
            'name' => 'required'
        ]);

        $data = \request()->all();

        $data['displays_in_menu'] = \request()->has('displays_in_menu') ? true : false;
        $data['featured'] = \request()->has('featured') ? true : false;
        $data['active'] = \request()->has('active') ? true : false;

        return $this->repository->update($category->id, $data);
    }

    public function destroy(Category $category)
    {
        $existsNewsWithThisCategory = News::where('category_id', $category->id)->get()->count();

        throw_if($existsNewsWithThisCategory, Exception::class, 'admin.error_fk_category');

        return $this->repository->destroy($category->id);
    }
}
