<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum UserPermission: string implements HasLabel
{
    case ViewUsers = 'users.view';
    case CreateUsers = 'users.create';
    case UpdateUsers = 'users.update';
    case DeleteUsers = 'users.delete';
    case ManageUserStatus = 'users.manage-status';
    case ManageUserRoles = 'users.manage-roles';

    public function getLabel(): string
    {
        return match ($this) {
            self::ViewUsers => __('View Users'),
            self::CreateUsers => __('Create Users'),
            self::UpdateUsers => __('Update Users'),
            self::DeleteUsers => __('Delete Users'),
            self::ManageUserStatus => __('Manage User Status'),
            self::ManageUserRoles => __('Manage User Roles'),
        };
    }
}
