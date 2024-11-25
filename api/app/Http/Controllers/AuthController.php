<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\Auth\LoginService;
use App\Services\Auth\LogoutService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(LoginRequest $loginRequest, LoginService $loginService): JsonResponse
    {
        $data = $loginRequest->validated();
        $token = $loginService->run($data);

        if(!$token){
            return response()->json('Email and password incorrect', 401);
        }

        return response()->json($token);
    }

    public function logout(LogoutService $logoutService): JsonResponse
    {
        $response = $logoutService->run();

        return response()->json($response);
    }
}
