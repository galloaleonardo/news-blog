<?php

namespace App\Repositories;

use App\Models\SeoMagazine;

class SeoMagazineRepository
{
    public function __construct(private SeoMagazine $model) {}

    public function getSeoMagazine()
    {
        return $this->model->first();
    }

    public function update(int $id, array $data)
    {
        return $this->model->findOrFail($id)->update($data);
    }
}
