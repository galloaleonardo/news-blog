<?php

namespace App\Services;

use App\Exceptions\ImageUploadFailedException;
use App\Helpers\Helper;
use App\Models\TopBanner;
use App\Repositories\TopBannerRepository;
use App\Services\ImageService;

class TopBannerService
{
    public function __construct(
        private TopBannerRepository $repository,
        private ImageService $image
    ) {}

    public function index()
    {
        return $this->repository->index();
    }

    public function store(array $data)
    {
        $data['active'] = isset($data['active']) ? true : false;

        try {
            $imageLink = $this->image->upload(request()->file('image_link'), 'top-banners')->save();
        } catch (\Throwable $th) {
            throw new ImageUploadFailedException(trans('admin.image_upload_error'));
        }

        $data['image_link'] = $imageLink;

        return $this->repository->store($data);
    }

    public function update(TopBanner $topBanner, array $data)
    {
        $request = request();

        if ($request->hasFile('image_link') && $request->file('image_link')->isValid()) {
            try {
                $imageLink = $this->image->upload($request->file('image_link'), 'top-banners')->save();

                Helper::deleteImage('images/top-banners/' . $topBanner->image_link);
            } catch (\Throwable $th) {
                throw new ImageUploadFailedException(trans('admin.image_upload_error'));
            }
            
            $data['image_link'] = $imageLink;
        }
            
        $data['active'] = isset($data['active']) ? true : false;

        return $this->repository->update($topBanner->id, $data);
    }

    public function destroy(TopBanner $topBanner)
    {
        Helper::deleteImage('images/top-banners/' . $topBanner->image_link);

        return $this->repository->destroy($topBanner->id);
    }
}
