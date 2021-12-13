<?php

namespace App\Services;

use App\Exceptions\ImageUploadFailedException;
use App\Helpers\Helper;
use Illuminate\Http\UploadedFile;

class IcoService
{
    public function upload(UploadedFile $image)
    {
        try {
            $name = 'icon_tab';
            $ico_name = "{$name}.ico";
            $path = public_path('images/ico/');

            Helper::checkPath([$path]);

            $image->move($path, $ico_name);

            return $ico_name;
        } catch (\Exception $e) {
            throw new ImageUploadFailedException();
        }

        return $ico_name;
    }
}
