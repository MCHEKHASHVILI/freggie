<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UpdateUserStatusRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserStatusController extends Controller
{
    /**
     * Activate or deactivate the specified user.
     */
    public function update(UpdateUserStatusRequest $request, User $user): JsonResponse
    {
        $user->update($request->safe()->only(['is_active']));

        return (new UserResource($user->load(['roles', 'profile'])))->response();
    }
}
