<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopBannerSettingRequest;
use App\Models\TopBannerSetting;
use App\Services\TopBannerSettingService;
use Illuminate\Http\Request;

class TopBannerSettingController extends CustomController
{
    const INDEX_ROUTE = 'top-banner.index';
    const OBJECT_MESSAGE = 'admin.settings';

    public function __construct(private TopBannerSettingService $service) {}
    
    public function update(TopBannerSettingRequest $request, TopBannerSetting $topBannerSetting)
    {
        try {
            $data = $request->validated();

            $this->service->update($topBannerSetting, $data);
        } catch (\Throwable $th) {
            return $this->responseRoute(
                $this::ERROR,
                $this::INDEX_ROUTE,
                $this::ERROR_UPDATE_MESSAGE,
                $this::OBJECT_MESSAGE
            );
        }

        return $this->responseRoute(
            $this::SUCCESS,
            $this::INDEX_ROUTE,
            $this::SUCCESS_UPDATE_MESSAGE,
            $this::OBJECT_MESSAGE
        );
    }
}
