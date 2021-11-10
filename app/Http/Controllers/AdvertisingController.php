<?php

namespace App\Http\Controllers;

use App\Models\Advertising;
use App\Services\AdvertisingService;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class AdvertisingController extends CustomController
{
    const INDEX_ROUTE = 'advertisements.index';
    const OBJECT_MESSAGE = 'admin.advertisings';

    public function __construct(private AdvertisingService $service) {}

    public function index()
    {
        $advertisements = $this->service->index();

        return view('admin.advertisements.index-advertisements', compact('advertisements'));
    }

    public function create()
    {
        return view('admin.advertisements.create-advertisements');
    }

    public function store(Request $request)
    {
        try {
            $this->service->store($request);
        } catch (\Throwable $th) {
            return $this->responseRoute(
                $this::ERROR,
                $this::INDEX_ROUTE,
                $this::ERROR_CREATE_MESSAGE,
                $this::OBJECT_MESSAGE
            );
        }

        return $this->responseRoute(
            $this::SUCCESS,
            $this::INDEX_ROUTE,
            $this::SUCCESS_CREATE_MESSAGE,
            $this::OBJECT_MESSAGE
        );
    }

    public function edit(Advertising $advertising)
    {
        return view('admin.advertisements.edit-advertisements', compact('advertising'));
    }

    public function update(Advertising $advertising)
    {
        try {
            $this->service->update($advertising);
        } catch (\Throwable $th) {
            return $this->responseRoute(
                $this::ERROR,
                $this::INDEX_ROUTE,
                $this::ERROR_UPDATE_MESSAGE,
                $this::OBJECT_MESSAGE
            );
        }

        return $this->responseRoute(
            $this::SUCCESS,
            $this::INDEX_ROUTE,
            $this::SUCCESS_UPDATE_MESSAGE,
            $this::OBJECT_MESSAGE
        );
    }

    public function destroy(Advertising $advertising)
    {
        try {
            $this->service->destroy($advertising);
        } catch (\Throwable $th) {
            return $this->responseRoute(
                $this::ERROR,
                $this::INDEX_ROUTE,
                [$this::ERROR_DELETE_MESSAGE, $th->getMessage()],
                $this::OBJECT_MESSAGE
            );
        }
    
        return $this->responseRoute(
            $this::SUCCESS,
            $this::INDEX_ROUTE,
            $this::SUCCESS_DELETE_MESSAGE,
            $this::OBJECT_MESSAGE
        );
    }
}
