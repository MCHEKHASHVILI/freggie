<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UpdateUserRolesRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserRoleController extends Controller
{
    /**
     * Sync the roles assigned to the specified user.
     */
    public function update(UpdateUserRolesRequest $request, User $user): JsonResponse
    {
        $user->syncRoles($request->safe()->array('roles'));

        return (new UserResource($user->load(['roles', 'profile'])))->response();
    }
}
