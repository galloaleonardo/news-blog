<?php

namespace App\Repositories;

use App\Models\Advertising;

class AdvertisingRepository
{
    public function __construct(private Advertising $model) {}

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
