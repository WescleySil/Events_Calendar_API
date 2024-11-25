<?php

namespace app\Services\User;

use Illuminate\Support\Facades\Hash;

class UpdateUserService
{
    public function run($data,$user){
        if(isset($data['password'])){
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        return $user;
    }
}
