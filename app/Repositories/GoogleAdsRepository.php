<?php

namespace App\Repositories;

use App\Models\GoogleAds;

class GoogleAdsRepository
{
    public function __construct(private GoogleAds $model) {}

    public function index()
    {
        return $this->model->first();
    }

    public function update(int $id, array $data)
    {
        return $this->model->findOrFail($id)->update($data);
    }
}
