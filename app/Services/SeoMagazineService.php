<?php

namespace App\Services;

use App\Exceptions\ImageUploadFailedException;
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

        if ($request->hasFile('image_link') && $request->file('image_link')->isValid()) {
            try {
                $imageLink = $this->image->uploadAndReturnName($request->file('image_link'), 'seo/small');
            } catch (\Throwable $th) {
                throw new ImageUploadFailedException(trans('admin.image_upload_error'));
            }
            
            $data['image_link'] = $imageLink;
        }

        $seoMagazine = $this->repository->getSeoMagazine();

        return $this->repository->update($seoMagazine->id, $data);
    }
}
