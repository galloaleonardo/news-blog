<?php

namespace App\Services;

use App\Exceptions\ImageUploadFailedException;
use App\Models\Advertising;
use App\Models\Author;
use App\Models\News;
use App\Repositories\AdvertisingRepository;
use App\Repositories\AuthorRepository;
use Exception;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'min:5', 'max:100'],
            'image_link' => $this->image->validateImage()
        ]);

        $data = $request->all();

        $data['active'] = $request->has('active') ? true : false;

        try {
            $imageLink = $this->image->uploadAndReturnName($request->file('image_link'), 'announcements');
        } catch (\Throwable $th) {
            throw new ImageUploadFailedException(trans('admin.image_upload_error'));
        }

        $data['image_link'] = $imageLink;

        return $this->repository->store($data);
    }

    public function update(Advertising $advertising)
    {
        $request = \request();

        $request->validate([
            'title' => ['required', 'min:5', 'max:100']
        ]);

        $data = \request()->all();

        if ($request->hasFile('image_link')) {
            $request->validate(['image_link' => $this->image->validateImage()]);

            try {
                $imageLink = $this->image->uploadAndReturnName($request->file('image_link'), 'announcements');
            } catch (\Throwable $th) {
                throw new ImageUploadFailedException(trans('admin.image_upload_error'));
            }
            
            $data['image_link'] = $imageLink;
        }
            
        $data['active'] = $request->has('active') ? true : false;

        return $this->repository->update($advertising->id, $data);
    }

    public function destroy(Advertising $advertising)
    {
        return $this->repository->destroy($advertising->id);
    }
}
