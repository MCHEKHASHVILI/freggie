<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\StoreUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a paginated, optionally searched listing of users.
     */
    public function index(Request $request): JsonResponse
    {
        Gate::authorize('viewAny', User::class);

        $search = $request->string('search')->trim()->toString();

        $users = User::query()
            ->with('roles')
            ->when($search !== '', fn ($query) => $query->where('email', 'like', "%{$search}%"))
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->paginate();

        return UserResource::collection($users)->response();
    }

    /**
     * Store a newly created user.
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        $user = User::create($request->safe()->only(['email', 'password']));

        return (new UserResource($user->load('roles')))->response()->setStatusCode(201);
    }

    /**
     * Display the specified user.
     */
    public function show(User $user): JsonResponse
    {
        Gate::authorize('view', $user);

        return (new UserResource($user->load('roles')))->response();
    }

    /**
     * Update the specified user.
     */
    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $user->update($request->safe()->only(['email', 'password']));

        return (new UserResource($user->load('roles')))->response();
    }

    /**
     * Remove the specified user.
     */
    public function destroy(User $user): JsonResponse
    {
        Gate::authorize('delete', $user);

        $user->delete();

        return response()->json(['message' => 'User deleted successfully.']);
    }
}
