<?php

use App\Enums\UserRole;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

it('returns 403 when the user lacks the create-users permission', function () {
    Sanctum::actingAs(User::factory()->withRole(UserRole::Admin->value)->create());

    $this->postJson('/api/users', [
        'email' => 'new@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ])->assertStatus(403);
});

it('creates a user and returns 201 for valid data', function () {
    Sanctum::actingAs(User::factory()->withRole(UserRole::Superadmin->value)->create());

    $response = $this->postJson('/api/users', [
        'email' => 'new@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertCreated()
        ->assertJsonPath('data.email', 'new@example.com')
        ->assertJsonPath('data.is_active', true);

    $this->assertDatabaseHas('users', ['email' => 'new@example.com']);
});

it('requires an email and a password', function () {
    Sanctum::actingAs(User::factory()->withRole(UserRole::Superadmin->value)->create());

    $this->postJson('/api/users', [])
        ->assertStatus(422)
        ->assertJsonValidationErrors(['email', 'password']);
});

it('rejects an email that is already taken', function () {
    Sanctum::actingAs(User::factory()->withRole(UserRole::Superadmin->value)->create());
    $existing = User::factory()->create();

    $this->postJson('/api/users', [
        'email' => $existing->email,
        'password' => 'password',
        'password_confirmation' => 'password',
    ])
        ->assertStatus(422)
        ->assertJsonValidationErrors('email');
});

it('rejects a password that does not match its confirmation', function () {
    Sanctum::actingAs(User::factory()->withRole(UserRole::Superadmin->value)->create());

    $this->postJson('/api/users', [
        'email' => 'new@example.com',
        'password' => 'password',
        'password_confirmation' => 'not-the-same',
    ])
        ->assertStatus(422)
        ->assertJsonValidationErrors('password');
});
