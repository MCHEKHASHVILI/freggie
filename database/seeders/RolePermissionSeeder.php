<?php

namespace Database\Seeders;

use App\Enums\UserPermission;
use App\Enums\UserRole;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = collect(UserPermission::cases())
            ->map(fn (UserPermission $permission) => Permission::findOrCreate($permission->value));

        $superadmin = Role::findOrCreate(UserRole::Superadmin->value);
        $superadmin->syncPermissions($permissions);

        $admin = Role::findOrCreate(UserRole::Admin->value);
        $admin->syncPermissions([UserPermission::ViewUsers->value]);
    }
}
