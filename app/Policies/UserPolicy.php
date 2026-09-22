<?php

namespace App\Policies;

use App\Enums\UserPermission;
use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo(UserPermission::ViewUsers->value);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return $user->hasPermissionTo(UserPermission::ViewUsers->value);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo(UserPermission::CreateUsers->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return $user->hasPermissionTo(UserPermission::UpdateUsers->value);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return $user->hasPermissionTo(UserPermission::DeleteUsers->value)
            && $user->isNot($model);
    }

    /**
     * Determine whether the user can activate or deactivate the model.
     */
    public function updateStatus(User $user, User $model): bool
    {
        return $user->hasPermissionTo(UserPermission::ManageUserStatus->value)
            && $user->isNot($model);
    }

    /**
     * Determine whether the user can assign roles to the model.
     */
    public function updateRoles(User $user, User $model): bool
    {
        return $user->hasPermissionTo(UserPermission::ManageUserRoles->value);
    }
}
