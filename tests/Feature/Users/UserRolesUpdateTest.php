<?php

use App\Enums\UserRole;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

it('returns 403 when the user lacks the manage-roles permission', function () {
    $target = User::factory()->create();
    Sanctum::actingAs(User::factory()->withRole(UserRole::Admin->value)->create());

    $this->putJson("/api/users/{$target->id}/roles", ['roles' => [UserRole::Admin->value]])
        ->assertStatus(403);
});

it('assigns the given roles to the user', function () {
    Sanctum::actingAs(User::factory()->withRole(UserRole::Superadmin->value)->create());
    $target = User::factory()->create();

    $this->putJson("/api/users/{$target->id}/roles", ['roles' => [UserRole::Admin->value]])
        ->assertOk()
        ->assertJsonPath('data.roles', [UserRole::Admin->value]);

    expect($target->fresh()->hasRole(UserRole::Admin->value))->toBeTrue();
});

it('removes existing roles when synced with an empty list', function () {
    Sanctum::actingAs(User::factory()->withRole(UserRole::Superadmin->value)->create());
    $target = User::factory()->withRole(UserRole::Admin->value)->create();

    $this->putJson("/api/users/{$target->id}/roles", ['roles' => []])
        ->assertOk()
        ->assertJsonPath('data.roles', []);

    expect($target->fresh()->roles)->toBeEmpty();
});

it('rejects a role name that does not exist', function () {
    Sanctum::actingAs(User::factory()->withRole(UserRole::Superadmin->value)->create());
    $target = User::factory()->create();

    $this->putJson("/api/users/{$target->id}/roles", ['roles' => ['not-a-real-role']])
        ->assertStatus(422)
        ->assertJsonValidationErrors('roles.0');
});

it('requires the roles field to be present', function () {
    Sanctum::actingAs(User::factory()->withRole(UserRole::Superadmin->value)->create());
    $target = User::factory()->create();

    $this->putJson("/api/users/{$target->id}/roles", [])
        ->assertStatus(422)
        ->assertJsonValidationErrors('roles');
});
