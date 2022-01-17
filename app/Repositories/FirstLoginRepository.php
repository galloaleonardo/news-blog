<?php

namespace App\Repositories;

use App\Models\User;

class FirstLoginRepository
{
    public function __construct(private User $user) {}

    public function updatePassword(int $id, array $data)
    {
        $user = $this->user->find($id);
        
        return $user->update([
            'password' => \Hash::make($data['password'])
        ]);
    }
}
