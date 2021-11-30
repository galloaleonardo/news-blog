<?php

namespace App\Services;

use App\Models\GoogleAds;
use App\Repositories\GoogleAdsRepository;

class GoogleAdsService
{
    public function __construct(private GoogleAdsRepository $repository) {}

    public function index()
    {
        return $this->repository->index();
    }

    public function update(GoogleAds $googleAds, array $data)
    {
        $data['active'] = isset($data['active']);

        return $this->repository->update($googleAds->id, $data);
    }
}
