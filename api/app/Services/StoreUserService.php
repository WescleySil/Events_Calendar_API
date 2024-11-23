<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StoreUserService
{
    public function __construct(private readonly User $user){}
    public function run($data){
        $data['password'] = Hash::make($data['password']);

        return $this->user->create($data);
    }
}
