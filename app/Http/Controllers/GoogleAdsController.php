<?php

namespace App\Http\Controllers;

use App\Http\Requests\GoogleAdsRequest;
use App\Models\GoogleAds;
use App\Services\GoogleAdsService;

class GoogleAdsController extends CustomController
{
    const INDEX_ROUTE = 'google-ads.index';
    const OBJECT_MESSAGE = 'admin.google_ads';

    public function __construct(private GoogleAdsService $service) {}

    public function index()
    {
        $googleAds = $this->service->index();

        return view('admin.google-ads.edit-google-ads', compact('googleAds'));
    }

    public function update(GoogleAdsRequest $request)
    {
        try {
            $data = $request->validated();

            $this->service->update($data);
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
