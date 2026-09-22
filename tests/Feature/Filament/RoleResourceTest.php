<?php

use App\Enums\UserPermission;
use App\Enums\UserRole;
use App\Filament\Resources\Roles\Pages\CreateRole;
use App\Filament\Resources\Roles\Pages\EditRole;
use App\Filament\Resources\Roles\Pages\ListRoles;
use App\Models\User;
use Livewire\Livewire;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

beforeEach(function () {
    $this->admin = User::factory()->withRole(UserRole::Superadmin->value)->create();
    $this->actingAs($this->admin);
});

it('lists existing roles', function () {
    Livewire::test(ListRoles::class)
        ->assertCanSeeTableRecords(Role::all());
});

it('creates a role with the selected permissions', function () {
    $permissionId = Permission::where('name', UserPermission::ViewUsers->value)->firstOrFail()->getKey();

    Livewire::test(CreateRole::class)
        ->fillForm([
            'name' => 'dispatcher',
            'permissions' => [$permissionId],
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $role = Role::where('name', 'dispatcher')->first();

    expect($role)->not->toBeNull()
        ->and($role->hasPermissionTo(UserPermission::ViewUsers->value))->toBeTrue();
});

it('rejects a duplicate role name', function () {
    Livewire::test(CreateRole::class)
        ->fillForm(['name' => UserRole::Admin->value])
        ->call('create')
        ->assertHasFormErrors(['name']);
});

it('updates an existing role\'s name and permissions', function () {
    $role = Role::findOrCreate('dispatcher');
    $permissionId = Permission::where('name', UserPermission::CreateUsers->value)->firstOrFail()->getKey();

    Livewire::test(EditRole::class, ['record' => $role->getRouteKey()])
        ->fillForm([
            'name' => 'senior-dispatcher',
            'permissions' => [$permissionId],
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $role = $role->fresh();

    expect($role->name)->toBe('senior-dispatcher')
        ->and($role->hasPermissionTo(UserPermission::CreateUsers->value))->toBeTrue();
});

it('deletes a role', function () {
    $role = Role::findOrCreate('dispatcher');

    Livewire::test(EditRole::class, ['record' => $role->getRouteKey()])
        ->callAction('delete');

    $this->assertDatabaseMissing('roles', ['id' => $role->id]);
});

it('prevents deleting the superadmin role', function () {
    $role = Role::where('name', UserRole::Superadmin->value)->firstOrFail();

    Livewire::test(EditRole::class, ['record' => $role->getRouteKey()])
        ->assertActionHidden('delete');

    $this->assertDatabaseHas('roles', ['id' => $role->id]);
});
