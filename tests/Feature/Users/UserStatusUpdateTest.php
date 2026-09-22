<?php

use App\Enums\UserRole;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

it('returns 403 when the user lacks the manage-status permission', function () {
    $target = User::factory()->create();
    Sanctum::actingAs(User::factory()->withRole(UserRole::Admin->value)->create());

    $this->putJson("/api/users/{$target->id}/status", ['is_active' => false])
        ->assertStatus(403);
});

it('deactivates another user', function () {
    Sanctum::actingAs(User::factory()->withRole(UserRole::Superadmin->value)->create());
    $target = User::factory()->create();

    $this->putJson("/api/users/{$target->id}/status", ['is_active' => false])
        ->assertOk()
        ->assertJsonPath('data.is_active', false);

    $this->assertDatabaseHas('users', ['id' => $target->id, 'is_active' => false]);
});

it('reactivates a deactivated user', function () {
    Sanctum::actingAs(User::factory()->withRole(UserRole::Superadmin->value)->create());
    $target = User::factory()->inactive()->create();

    $this->putJson("/api/users/{$target->id}/status", ['is_active' => true])
        ->assertOk()
        ->assertJsonPath('data.is_active', true);
});

it('returns 403 when a user tries to deactivate their own account', function () {
    $admin = User::factory()->withRole(UserRole::Superadmin->value)->create();
    Sanctum::actingAs($admin);

    $this->putJson("/api/users/{$admin->id}/status", ['is_active' => false])
        ->assertStatus(403);
});

it('requires is_active to be a boolean', function () {
    Sanctum::actingAs(User::factory()->withRole(UserRole::Superadmin->value)->create());
    $target = User::factory()->create();

    $this->putJson("/api/users/{$target->id}/status", ['is_active' => 'not-a-boolean'])
        ->assertStatus(422)
        ->assertJsonValidationErrors('is_active');
});
