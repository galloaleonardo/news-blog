<?php

namespace App\Repositories;

use App\Models\Settings;

class SettingsRepository
{
    public function __construct(private Settings $model) {}

    public function getSettings()
    {
        return $this->model->first();
    }

    public function update(int $id, array $data)
    {
        return $this->model->findOrFail($id)->update($data);
    }
}
