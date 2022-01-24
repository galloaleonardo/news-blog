<?php

namespace App\Services;

use App\Exceptions\ImageUploadFailedException;
use App\Helpers\Helper;
use App\Models\Advertising;
use App\Repositories\AdvertisingRepository;
use File;

class AdvertisingService
{
    public function __construct(
        private AdvertisingRepository $repository,
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
            $imageLink = $this->image->upload(request()->file('image_link'), 'announcements')->save();
        } catch (\Throwable $th) {
            throw new ImageUploadFailedException(trans('admin.image_upload_error'));
        }

        $data['image_link'] = $imageLink;

        return $this->repository->store($data);
    }

    public function update(Advertising $advertising, array $data)
    {
        $request = request();

        if ($request->hasFile('image_link') && $request->file('image_link')->isValid()) {
            try {
                $imageLink = $this->image->upload($request->file('image_link'), 'announcements')->save();

                Helper::deleteImage('images/announcements/' . $advertising->image_link);
            } catch (\Throwable $th) {
                throw new ImageUploadFailedException(trans('admin.image_upload_error'));
            }
            
            $data['image_link'] = $imageLink;
        }
            
        $data['active'] = isset($data['active']) ? true : false;

        return $this->repository->update($advertising->id, $data);
    }

    public function destroy(Advertising $advertising)
    {
        Helper::deleteImage('images/announcements/' . $advertising->image_link);

        return $this->repository->destroy($advertising->id);
    }
}
