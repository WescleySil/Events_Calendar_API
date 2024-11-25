<?php

namespace app\Services\User;

use App\Models\User;

class IndexUserService
{
    public function run($data){
        return User::all();
    }
}
