<?php

namespace App\Services;

use App\User;

class UserService
{
    public function create(array $data)
    {
        return User::create($data);
    }

}
