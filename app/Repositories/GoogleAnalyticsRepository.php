<?php

namespace App\Repositories;

use App\Models\GoogleAnalytics;

class GoogleAnalyticsRepository
{
    public function __construct(private GoogleAnalytics $model) {}

    public function getGoogleAnalytics()
    {
        return $this->model->first();
    }

    public function update(int $id, array $data)
    {
        return $this->model->findOrFail($id)->update($data);
    }
}
