<?php

namespace App\Services\Auth;



use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginService
{
    public function run($data){
        $user = User::where('email', $data['login'])
            ->orWhere('username', $data['login'])
            ->first();
        if($user){
            if(Auth::attempt(['email'=>$user->email, 'password'=>$data['password']])){
                return $user->createToken('token')->plainTextToken;
            };
        }
        return null;
    }
}
