<?php

use App\Enums\UserRole;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

it('returns 403 when the user lacks the delete-users permission', function () {
    $target = User::factory()->create();
    Sanctum::actingAs(User::factory()->withRole(UserRole::Admin->value)->create());

    $this->deleteJson("/api/users/{$target->id}")->assertStatus(403);
});

it('deletes another user for an authorized user', function () {
    Sanctum::actingAs(User::factory()->withRole(UserRole::Superadmin->value)->create());
    $target = User::factory()->create();

    $this->deleteJson("/api/users/{$target->id}")->assertOk();

    $this->assertDatabaseMissing('users', ['id' => $target->id]);
});

it('returns 403 when a user tries to delete their own account', function () {
    $admin = User::factory()->withRole(UserRole::Superadmin->value)->create();
    Sanctum::actingAs($admin);

    $this->deleteJson("/api/users/{$admin->id}")->assertStatus(403);

    $this->assertDatabaseHas('users', ['id' => $admin->id]);
});
