<?php

use App\Enums\UserPermission;
use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

beforeEach(function () {
    collect(UserPermission::cases())
        ->each(fn (UserPermission $permission) => Permission::findOrCreate($permission->value));

    $this->policy = new UserPolicy;
});

it('grants the ability only to a user with the matching permission', function (string $ability, UserPermission $permission, bool $needsTarget) {
    $authorized = User::factory()->create();
    $authorized->givePermissionTo($permission->value);
    $unauthorized = User::factory()->create();
    $target = User::factory()->create();

    $call = fn (User $actor) => $needsTarget
        ? $this->policy->{$ability}($actor, $target)
        : $this->policy->{$ability}($actor);

    expect($call($authorized))->toBeTrue()
        ->and($call($unauthorized))->toBeFalse();
})->with([
    'viewAny requires users.view' => ['viewAny', UserPermission::ViewUsers, false],
    'view requires users.view' => ['view', UserPermission::ViewUsers, true],
    'create requires users.create' => ['create', UserPermission::CreateUsers, false],
    'update requires users.update' => ['update', UserPermission::UpdateUsers, true],
    'updateRoles requires users.manage-roles' => ['updateRoles', UserPermission::ManageUserRoles, true],
]);

it('forbids delete without the delete-users permission', function () {
    $user = User::factory()->create();
    $other = User::factory()->create();

    expect($this->policy->delete($user, $other))->toBeFalse();
});

it('allows delete on another user with the delete-users permission', function () {
    $user = User::factory()->create();
    $user->givePermissionTo(UserPermission::DeleteUsers->value);
    $other = User::factory()->create();

    expect($this->policy->delete($user, $other))->toBeTrue();
});

it('forbids delete on the acting user even with the delete-users permission', function () {
    $user = User::factory()->create();
    $user->givePermissionTo(UserPermission::DeleteUsers->value);

    expect($this->policy->delete($user, $user))->toBeFalse();
});

it('forbids updateStatus without the manage-status permission', function () {
    $user = User::factory()->create();
    $other = User::factory()->create();

    expect($this->policy->updateStatus($user, $other))->toBeFalse();
});

it('allows updateStatus on another user with the manage-status permission', function () {
    $user = User::factory()->create();
    $user->givePermissionTo(UserPermission::ManageUserStatus->value);
    $other = User::factory()->create();

    expect($this->policy->updateStatus($user, $other))->toBeTrue();
});

it('forbids updateStatus on the acting user even with the manage-status permission', function () {
    $user = User::factory()->create();
    $user->givePermissionTo(UserPermission::ManageUserStatus->value);

    expect($this->policy->updateStatus($user, $user))->toBeFalse();
});
