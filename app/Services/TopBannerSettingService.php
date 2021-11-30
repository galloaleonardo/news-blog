<?php

namespace App\Services;

use App\Models\TopBannerSetting;
use App\Repositories\TopBannerSettingRepository;
use App\Services\ImageService;

class TopBannerSettingService
{
    public function __construct(
        private TopBannerSettingRepository $repository,
        private ImageService $image
    ) {}

    public function update(TopBannerSetting $topBannerSetting, array $data)
    {
        $data['active'] = isset($data['active']) ? true : false;
        $data['keep_on_top_when_scrolling'] = isset($data['keep_on_top_when_scrolling']) ? true : false;

        $this->repository->update($topBannerSetting->id, $data);
    }
}
