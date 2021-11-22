<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopBannerRequest;
use App\Models\TopBanner;
use App\Models\TopBannerSetting;

class TopBannerController extends CustomController
{
    const INDEX_ROUTE = 'top-banner.index';
    const OBJECT_MESSAGE = 'admin.top_banner';

    public function __construct(private TopBannerService $service) {}

    public function index()
    {
        $topBannerSetting = TopBannerSetting::first();

        $topBanners = $this->service->index();

        return view('admin.top-banner.index-top-banner', compact('topBannerSetting', 'topBanners'));
    }

    public function create()
    {
        return view('admin.top-banner.create-top-banner');
    }

    public function store(TopBannerRequest $request)
    {
        try {
            $data = $request->validated();

            $this->service->store($data);
        } catch (\Throwable $th) {
            return $this->responseRoute(
                $this::ERROR,
                $this::INDEX_ROUTE,
                $this::ERROR_CREATE_MESSAGE,
                $this::OBJECT_MESSAGE
            );
        }

        return $this->responseRoute(
            $this::SUCCESS,
            $this::INDEX_ROUTE,
            $this::SUCCESS_CREATE_MESSAGE,
            $this::OBJECT_MESSAGE
        );
    }

    public function edit(TopBanner $topBanner)
    {
        return view('admin.top-banner.edit-top-banner', compact('topBanner'));
    }

    public function update(TopBannerRequest $request, TopBanner $topBanner)
    {
        try {
            $data = $request->validated();

            $this->service->update($topBanner, $data);
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

    public function destroy(TopBanner $topBanner)
    {
        try {
            $this->service->destroy($topBanner);
        } catch (\Throwable $th) {
            return $this->responseRoute(
                $this::ERROR,
                $this::INDEX_ROUTE,
                [$this::ERROR_DELETE_MESSAGE, $th->getMessage()],
                $this::OBJECT_MESSAGE
            );
        }
    
        return $this->responseRoute(
            $this::SUCCESS,
            $this::INDEX_ROUTE,
            $this::SUCCESS_DELETE_MESSAGE,
            $this::OBJECT_MESSAGE
        );
    }
}
