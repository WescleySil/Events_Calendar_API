<?php

namespace App\Services;

class DeleteUserService
{
    public  function run($user)
    {
        return $user->delete();
    }
}
