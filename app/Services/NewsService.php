<?php

namespace App\Services;

use App\Exceptions\ImageUploadFailedException;
use App\Helpers\Helper;
use App\Models\News;
use App\Repositories\NewsRepository;
use App\Services\ImageService;
use Illuminate\Http\Request;

class NewsService
{
    public function __construct(
        private NewsRepository $repository,
        private ImageService $image
    ) {}

    public function index()
    {
        return $this->repository->index();
    }

    public function store(array $data)
    {
        $data['active'] = isset($data['active']) ? true : false;
        $data['featured'] = isset($data['featured']) ? true : false;
        $data['content'] = str_replace('<p>', '<p class="mtb-40">', $data['content']);

        try {
            $imageName = Helper::getRandomImageName();

            $imageLink = $this->image->upload(request()->file('image_link'), 'news/large', $imageName)->save();
            $this->image->upload(request()->file('image_link'), 'news/small', $imageName)->size(300)->save();
        } catch (\Throwable $th) {
            throw new ImageUploadFailedException(trans('admin.image_upload_error'));
        }

        $data['image_link'] = $imageLink;

        return $this->repository->store($data);
    }

    public function update(News $news, array $data)
    {
        $request = request();

        if ($request->hasFile('image_link') && $request->file('image_link')->isValid()) {
            try {
                $imageName = Helper::getRandomImageName();

                $imageLink = $this->image->upload($request->file('image_link'), 'news/large', $imageName)->save();
                $this->image->upload($request->file('image_link'), 'news/small', $imageName)->size(300)->save();

                Helper::deleteImage('images/news/large/' . $news->image_link);
                Helper::deleteImage('images/news/small/' . $news->image_link);
            } catch (\Throwable $th) {
                throw new ImageUploadFailedException(trans('admin.image_upload_error'));
            }
            
            $data['image_link'] = $imageLink;
        }
            
        $data['active'] = isset($data['active']) ? true : false;
        $data['featured'] = isset($data['featured']) ? true : false;

        if (isset($data['content'])) {
            $data['content'] = str_replace('<p>', '<p class="mtb-40">', $data['content']);
        }

        return $this->repository->update($news->id, $data);
    }

    public function destroy(News $news)
    {
        Helper::deleteImage('images/news/large/' . $news->image_link);
        Helper::deleteImage('images/news/small/' . $news->image_link);

        return $this->repository->destroy($news->id);
    }

    public function search(Request $request)
    {
        return $this->repository->search($request);
    }
}
