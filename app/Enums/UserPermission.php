<?php

namespace App\Enums;

enum UserPermission: string
{
    case ViewUsers = 'users.view';
    case CreateUsers = 'users.create';
    case UpdateUsers = 'users.update';
    case DeleteUsers = 'users.delete';
    case ManageUserStatus = 'users.manage-status';
    case ManageUserRoles = 'users.manage-roles';
}
