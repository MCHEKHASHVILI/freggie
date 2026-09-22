<?php

use App\Enums\UserRole;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

it('returns 403 when the user lacks the view-users permission', function () {
    $target = User::factory()->create();
    Sanctum::actingAs(User::factory()->create());

    $this->getJson("/api/users/{$target->id}")->assertStatus(403);
});

it('returns the user for an authorized user', function () {
    $admin = User::factory()->withRole(UserRole::Superadmin->value)->create();
    $target = User::factory()->create();
    Sanctum::actingAs($admin);

    $this->getJson("/api/users/{$target->id}")
        ->assertOk()
        ->assertJsonPath('data.id', $target->id)
        ->assertJsonPath('data.email', $target->email);
});

it('returns 404 for a user that does not exist', function () {
    Sanctum::actingAs(User::factory()->withRole(UserRole::Superadmin->value)->create());

    $this->getJson('/api/users/999999')->assertStatus(404);
});
