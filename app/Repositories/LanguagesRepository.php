<?php

namespace App\Repositories;

use App\Models\Languages;

class LanguagesRepository
{
    public function __construct(private Languages $model) {}

    public function index()
    {
        return $this->model->all();
    }
}
