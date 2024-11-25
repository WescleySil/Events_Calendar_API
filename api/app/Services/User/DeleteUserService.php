<?php

namespace app\Services\User;

class DeleteUserService
{
    public  function run($user)
    {
        return $user->delete();
    }
}
