<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
    /**
     * Update the authenticated user's own profile.
     */
    public function update(UpdateProfileRequest $request): JsonResponse
    {
        $user = $request->user();

        $user->profile->update($request->safe()->only(['name', 'surname', 'phone']));

        if ($request->hasFile('avatar')) {
            $user->profile->addMediaFromRequest('avatar')->toMediaCollection('avatar');
        }

        return (new UserResource($user->fresh(['roles', 'profile'])))->response();
    }
}
