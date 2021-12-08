<?php

namespace App\Services;

use App\Exceptions\ImageUploadFailedException;
use App\Http\Controllers\LanguagesController;
use App\Repositories\LanguagesRepository;
use App\Repositories\SettingsRepository;

class SettingsService
{
    public function __construct(
        private SettingsRepository $settingsRepository,
        private LanguagesRepository $languagesRepository,
        private ImageService $image,
        private IcoService $ico
    ) {}

    public function settingsIndex()
    {
        return $this->settingsRepository->getSettings();
    }

    public function languagesIndex()
    {
        return $this->languagesRepository->index();
    }

    public function update(array $data)
    {
        $request = request();

        if ($request->hasFile('company_logo_link') && $request->file('company_logo_link')->isValid()) {
            try {
                $imageLink = $this->image->uploadAndReturnName($request->file('company_logo_link'), 'logo');
            } catch (\Throwable $th) {
                throw new ImageUploadFailedException(trans('admin.image_upload_error'));
            }
            
            $data['company_logo_link'] = $imageLink;
        }

        if ($request->hasFile('icon_tab_link') && $request->file('icon_tab_link')->isValid()) {
            try {
                $imageLink = $this->ico->uploadAndReturnName($request->file('icon_tab_link'), 'ico');
            } catch (\Throwable $th) {
                dd($th->getMessage());
                throw new ImageUploadFailedException(trans('admin.image_upload_error'));
            }
            
            $data['icon_tab_link'] = $imageLink;
        }

        $data['use_logo_by_default'] = isset($data['use_logo_by_default']) ? true : false;

        $settings = $this->settingsRepository->getSettings();

        return $this->settingsRepository->update($settings->id, $data);
    }
}
