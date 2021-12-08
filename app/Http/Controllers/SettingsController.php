<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingsRequest;
use App\Services\SettingsService;
use Illuminate\Http\Request;

class SettingsController extends CustomController
{
    const INDEX_ROUTE = 'settings.index';
    const OBJECT_MESSAGE = 'admin.settings';

    public function __construct(private SettingsService $service) {}

    public function index()
    {
        $settings = $this->service->settingsIndex();
        $languages = $this->service->languagesIndex();

        return view('admin.settings.edit-settings', compact('settings', 'languages'));
    }

    public function update(SettingsRequest $request)
    {
        try {
            $data = $request->validated();

            $this->service->update($data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
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
