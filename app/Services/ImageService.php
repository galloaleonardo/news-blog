<?php

namespace App\Services;

use App\Helpers\Helper;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;

class ImageService
{
    public static function uploadAndReturnName(UploadedFile $image, string $path, int $quality = 60): string
    {
        $name = Helper::getRandomImageName();
        $jpg_name = "{$name}.jpg";

        $path = substr($path, 0, 1) === '/' ? substr($path, 0, 1) : $path;
        $path = substr($path, -1) === '/' ? substr($path, 0, -1) : $path;

        $path_large = public_path("images/$path/");

        Helper::checkPath([$path_large]);

        Image::make($image)
            ->encode('jpg', $quality)
            ->save($path_large . $jpg_name);

        return $jpg_name;
    }

    public static function validateImage(): array
    {
        return  [
            'required',
            'image',
            'mimes:jpeg,jpg,png'
        ];
    }
}
