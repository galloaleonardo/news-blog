<?php

namespace App\Repositories;

use App\Models\TopBannerSetting;

class TopBannerSettingRepository
{
    public function __construct(private TopBannerSetting $model) {}

    public function update(int $id, array $data)
    {
        return $this->model->findOrFail($id)->update($data);
    }
}
