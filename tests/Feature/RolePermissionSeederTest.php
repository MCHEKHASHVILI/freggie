<?php

use App\Enums\UserRole;
use Database\Seeders\RolePermissionSeeder;
use Spatie\Permission\Models\Role;

it('creates the director, manager, and courier roles', function () {
    $this->seed(RolePermissionSeeder::class);

    expect(Role::where('name', UserRole::Director->value)->exists())->toBeTrue()
        ->and(Role::where('name', UserRole::Manager->value)->exists())->toBeTrue()
        ->and(Role::where('name', UserRole::Courier->value)->exists())->toBeTrue();
});

it('does not assign any permissions to the director, manager, and courier roles', function () {
    $this->seed(RolePermissionSeeder::class);

    expect(Role::where('name', UserRole::Director->value)->firstOrFail()->permissions)->toBeEmpty()
        ->and(Role::where('name', UserRole::Manager->value)->firstOrFail()->permissions)->toBeEmpty()
        ->and(Role::where('name', UserRole::Courier->value)->firstOrFail()->permissions)->toBeEmpty();
});
