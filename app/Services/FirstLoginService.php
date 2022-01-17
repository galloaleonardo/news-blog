<?php

namespace App\Services;

use App\Repositories\FirstLoginRepository;

class FirstLoginService
{
    public function __construct(private FirstLoginRepository $repository) {}

    public function updatePassword(int $id, array $data)
    {
        return $this->repository->updatePassword($id, $data);
    }
}