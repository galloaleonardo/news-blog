<?php

namespace App\Http\Controllers;

use App\Http\Requests\GoogleAnalyticsRequest;
use App\Services\GoogleAnalyticsService;

class GoogleAnalyticsController extends CustomController
{
    const INDEX_ROUTE = 'google-analytics.index';
    const OBJECT_MESSAGE = 'admin.google_analytics';

    public function __construct(private GoogleAnalyticsService $service) {}

    public function index()
    {
        $googleAnalytics = $this->service->index();

        return view('admin.google-analytics.edit-google-analytics', compact('googleAnalytics'));
    }

    public function update(GoogleAnalyticsRequest $request)
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
