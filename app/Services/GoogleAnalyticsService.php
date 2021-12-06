<?php

namespace App\Services;

use App\Repositories\GoogleAnalyticsRepository;

class GoogleAnalyticsService
{
    public function __construct(private GoogleAnalyticsRepository $repository) {}

    public function index()
    {
        return $this->repository->getGoogleAnalytics();
    }

    public function update(array $data)
    {
        $data['active'] = isset($data['active']);

        $googleAds = $this->repository->getGoogleAnalytics();

        return $this->repository->update($googleAds->id, $data);
    }
}
