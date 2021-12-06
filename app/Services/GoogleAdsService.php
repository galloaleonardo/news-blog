<?php

namespace App\Services;

use App\Repositories\GoogleAdsRepository;

class GoogleAdsService
{
    public function __construct(private GoogleAdsRepository $repository) {}

    public function index()
    {
        return $this->repository->getGoogleAds();
    }

    public function update(array $data)
    {
        $data['active'] = isset($data['active']);

        $googleAds = $this->repository->getGoogleAds();

        return $this->repository->update($googleAds->id, $data);
    }
}
