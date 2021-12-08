<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeoMagazineRequest;
use App\Services\SeoMagazineService;

class SeoMagazineController extends CustomController
{

    const INDEX_ROUTE = 'seo.index';
    const OBJECT_MESSAGE = 'admin.seo';

    public function __construct(private SeoMagazineService $service) {}

    public function index()
    {
        $seo = $this->service->index();

        return view('admin.seo.edit-seo', compact('seo'));
    }


    public function update(SeoMagazineRequest $request)
    {
        try {
            $data = $request->validated();

            $this->service->update($data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
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
}
