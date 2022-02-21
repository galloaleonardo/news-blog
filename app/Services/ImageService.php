<?php

namespace App\Services;

use App\Exceptions\ImageUploadFailedException;
use App\Helpers\Helper;
use Spatie\ImageOptimizer\OptimizerChainFactory;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;

class ImageService
{
    private $image;
    private string $imageName;
    private string $imagePathName;

    public function upload(UploadedFile $image, string $path, string $name = '', string $ext = 'jpg')
    {
        try {
            if (!$name) {
                $name = Helper::getRandomImageName();
            }
            
            $this->imageName = "{$name}.{$ext}";

            $path = substr($path, 0, 1) === '/' ? substr($path, 0, 1) : $path;
            $path = substr($path, -1) === '/' ? substr($path, 0, -1) : $path;

            $fullPath = public_path("images/$path/");

            Helper::checkPath([$fullPath]);

            $this->imagePathName = $fullPath . $this->imageName;

            $this->image = Image::make($image)
                ->encode($ext, 60);
        } catch (\Exception $e) {
            throw new ImageUploadFailedException();
        }

        return $this;
    }

    public function size(int $weight)
    {
        try {
            $this->image->resize($weight, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        } catch (\Exception $e) {
            throw new ImageUploadFailedException();
        }

        return $this;
    }

    public function save()
    {
        try {
            $this->image->save($this->imagePathName);

            $optimizerChain = OptimizerChainFactory::create();
            $optimizerChain->optimize($this->imagePathName);
        } catch (\Exception $e) {
            throw new ImageUploadFailedException();
        }

        return $this->imageName;
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
