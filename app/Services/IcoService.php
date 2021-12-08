<?php

namespace App\Services;

use App\Helpers\Helper;
use Illuminate\Http\UploadedFile;

class IcoService
{
    public function uploadAndReturnName(UploadedFile $image)
    {
        $name = 'icon_tab';
        $ico_name = "{$name}.ico";
        $path = public_path('images/ico/');

        Helper::checkPath([$path]);

        $image->move($path, $ico_name);

        return $ico_name;
    }
}
