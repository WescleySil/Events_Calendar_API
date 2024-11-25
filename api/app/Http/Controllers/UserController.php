<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\User\DeleteUserService;
use App\Services\User\IndexUserService;
use App\Services\User\StoreUserService;
use App\Services\User\UpdateUserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    public function index(IndexUserRequest $indexUserRequest,IndexUserService $indexUserService): AnonymousResourceCollection
    {
        $data = $indexUserRequest->validated();
        $users = $indexUserService->run($data);

        return UserResource::collection($users);
    }

    public function store(StoreUserRequest $storeUserRequest, StoreUserService $storeUserService): JsonResponse
    {
        $data = $storeUserRequest->validated();
        $user = $storeUserService->run($data);

        return response()->json(new UserResource($user), 201);
    }

    public function update(UpdateUserRequest $updateUserRequest, UpdateUserService $updateUserService, User $user): JsonResponse
    {
        $data = $updateUserRequest->validated();
        $updatedUser = $updateUserService->run($data, $user);

        return response()->json(new UserResource($updatedUser), 200);
    }

    public function destroy(DeleteUserService $deleteUserService, User $user): JsonResponse{

        $deleteUserService->run($user);

        return response()->json(null, 204);
    }
}
