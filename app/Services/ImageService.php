<?php

namespace App\Services;

use App\Exceptions\ImageUploadFailedException;
use App\Helpers\Helper;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;

class ImageService
{
    public function uploadAndReturnName(UploadedFile $image, string $path, int $quality = 60): string
    {
        try {
            $name = Helper::getRandomImageName();
            $jpg_name = "{$name}.jpg";

            $path = substr($path, 0, 1) === '/' ? substr($path, 0, 1) : $path;
            $path = substr($path, -1) === '/' ? substr($path, 0, -1) : $path;

            $path_large = public_path("images/$path/");

            Helper::checkPath([$path_large]);

            Image::make($image)
                ->encode('jpg', $quality)
                ->save($path_large . $jpg_name);
        } catch (\Exception $e) {
            throw new ImageUploadFailedException();
        }

        return $jpg_name;
    }

    public function validateImage(): array
    {
        return  [
            'required',
            'image',
            'mimes:jpeg,jpg,png'
        ];
    }
}
