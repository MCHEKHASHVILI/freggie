<?php

use App\Enums\UserRole;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

it('returns 401 when unauthenticated', function () {
    $this->getJson('/api/users')->assertStatus(401);
});

it('returns 403 when the user lacks the view-users permission', function () {
    Sanctum::actingAs(User::factory()->create());

    $this->getJson('/api/users')->assertStatus(403);
});

it('lists every user for an authorized user', function () {
    $admin = User::factory()->withRole(UserRole::Superadmin->value)->create();
    User::factory()->count(2)->create();
    Sanctum::actingAs($admin);

    $this->getJson('/api/users')
        ->assertOk()
        ->assertJsonCount(3, 'data');
});

it('filters users by a search term matching the email', function () {
    $admin = User::factory()->withRole(UserRole::Superadmin->value)->create();
    $match = User::factory()->create(['email' => 'ada@example.com']);
    User::factory()->create(['email' => 'someone@example.com']);
    Sanctum::actingAs($admin);

    $this->getJson('/api/users?search=ada@')
        ->assertOk()
        ->assertJsonCount(1, 'data')
        ->assertJsonPath('data.0.id', $match->id);
});
