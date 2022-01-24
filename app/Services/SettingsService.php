<?php

namespace App\Services;

use App\Exceptions\ImageUploadFailedException;
use App\Helpers\Helper;
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

        $settings = $this->settingsRepository->getSettings();

        if ($request->hasFile('company_logo_link') && $request->file('company_logo_link')->isValid()) {
            try {
                $imageLink = $this->image->upload(
                    $request->file('company_logo_link'),
                    'logo',
                    'logo',
                    'png'
                )->size(150)->save();

                Helper::deleteImage('images/logo/logo.png');
            } catch (\Throwable $th) {
                throw new ImageUploadFailedException(trans('admin.image_upload_error'));
            }
            
            $data['company_logo_link'] = $imageLink;
        }

        if ($request->hasFile('icon_tab_link') && $request->file('icon_tab_link')->isValid()) {
            try {
                $imageLink = $this->ico->upload($request->file('icon_tab_link'), 'ico');
                Helper::deleteImage('images/ico/icon_tab.ico');
            } catch (\Throwable $th) {
                dd($th->getMessage());
                throw new ImageUploadFailedException(trans('admin.image_upload_error'));
            }
            
            $data['icon_tab_link'] = $imageLink;
        }

        $data['use_logo_by_default'] = isset($data['use_logo_by_default']) ? true : false;

        return $this->settingsRepository->update($settings->id, $data);
    }
}
