<?php

use App\Models\User;

it('returns a token and the user for valid credentials', function () {
    $user = User::factory()->create();

    $this->postJson('/api/login', [
        'email' => $user->email,
        'password' => 'password',
    ])
        ->assertOk()
        ->assertJsonPath('data.id', $user->id)
        ->assertJsonStructure(['data' => ['id', 'email', 'is_active', 'roles'], 'token']);
});

it('returns 422 when the password is wrong', function () {
    $user = User::factory()->create();

    $this->postJson('/api/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ])
        ->assertStatus(422)
        ->assertJsonValidationErrors('email');
});

it('returns 422 when no user matches the email', function () {
    $this->postJson('/api/login', [
        'email' => 'nobody@example.com',
        'password' => 'password',
    ])
        ->assertStatus(422)
        ->assertJsonValidationErrors('email');
});

it('returns 422 when the account is deactivated', function () {
    $user = User::factory()->inactive()->create();

    $this->postJson('/api/login', [
        'email' => $user->email,
        'password' => 'password',
    ])
        ->assertStatus(422)
        ->assertJsonPath('errors.email.0', 'Your account has been deactivated.');
});

it('requires an email and a password', function () {
    $this->postJson('/api/login', [])
        ->assertStatus(422)
        ->assertJsonValidationErrors(['email', 'password']);
});
