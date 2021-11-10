<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function __construct(private Category $model) {}

    public function index()
    {
        return $this->model->paginate(10);
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->model->findOrFail($id)->update($data);
    }

    public function destroy(int $id)
    {
        return $this->model->findOrFail($id)->delete();
    }
}
