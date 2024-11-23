<?php

namespace App\Services;

use App\Models\User;

class IndexUserService
{
    public function run($data){
        return User::all();
    }
}
