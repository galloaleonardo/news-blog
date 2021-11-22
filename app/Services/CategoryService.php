<?php

namespace App\Services;

use App\Models\Category;
use App\Models\News;
use App\Repositories\CategoryRepository;
use Exception;

class CategoryService
{
    public function __construct(private CategoryRepository $repository) {}

    public function index()
    {
        return $this->repository->index();
    }

    public function store(array $data)
    {
        $data['displays_in_menu'] = isset($data['displays_in_menu']) ? true : false;
        $data['featured'] = isset($data['featured']) ? true : false;
        $data['active'] = isset($data['active']) ? true : false;

        return $this->repository->store($data);
    }

    public function update(Category $category, array $data)
    {
        $data['displays_in_menu'] = isset($data['displays_in_menu']) ? true : false;
        $data['featured'] = isset($data['featured']) ? true : false;
        $data['active'] = isset($data['active']) ? true : false;

        return $this->repository->update($category->id, $data);
    }

    public function destroy(Category $category)
    {
        $existsNewsWithThisCategory = News::where('category_id', $category->id)->get()->count();

        throw_if($existsNewsWithThisCategory, Exception::class, 'admin.error_fk_category');

        return $this->repository->destroy($category->id);
    }
}
