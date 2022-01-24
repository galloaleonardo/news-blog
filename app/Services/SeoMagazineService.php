<?php

namespace App\Services;

use App\Exceptions\ImageUploadFailedException;
use App\Helpers\Helper;
use App\Repositories\SeoMagazineRepository;

class SeoMagazineService
{
    public function __construct(
        private SeoMagazineRepository $repository,
        private ImageService $image
    ) {}

    public function index()
    {
        return $this->repository->getSeoMagazine();
    }

    public function update(array $data)
    {
        $request = request();

        $seoMagazine = $this->repository->getSeoMagazine();

        if ($request->hasFile('image_link') && $request->file('image_link')->isValid()) {
            try {
                $imageLink = $this->image->upload($request->file('image_link'), 'seo/small')->save();
                Helper::deleteImage('images/seo/small/' . $seoMagazine->image_link);
            } catch (\Throwable $th) {
                throw new ImageUploadFailedException(trans('admin.image_upload_error'));
            }
            
            $data['image_link'] = $imageLink;
        }

        return $this->repository->update($seoMagazine->id, $data);
    }
}
