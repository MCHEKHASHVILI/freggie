<?php

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;

it('returns 403 when the user lacks the update-users permission', function () {
    $target = User::factory()->create();
    Sanctum::actingAs(User::factory()->withRole(UserRole::Admin->value)->create());

    $this->putJson("/api/users/{$target->id}", ['email' => 'new-email@example.com'])
        ->assertStatus(403);
});

it('updates the email for valid data', function () {
    Sanctum::actingAs(User::factory()->withRole(UserRole::Superadmin->value)->create());
    $target = User::factory()->create();

    $this->putJson("/api/users/{$target->id}", ['email' => 'updated@example.com'])
        ->assertOk()
        ->assertJsonPath('data.email', 'updated@example.com');

    $this->assertDatabaseHas('users', ['id' => $target->id, 'email' => 'updated@example.com']);
});

it('allows a partial update of only the password', function () {
    Sanctum::actingAs(User::factory()->withRole(UserRole::Superadmin->value)->create());
    $target = User::factory()->create(['email' => 'unchanged@example.com']);

    $this->putJson("/api/users/{$target->id}", [
        'password' => 'new-password',
        'password_confirmation' => 'new-password',
    ])
        ->assertOk()
        ->assertJsonPath('data.email', 'unchanged@example.com');

    expect(Hash::check('new-password', $target->fresh()->password))->toBeTrue();
});

it('rejects an email already used by another user', function () {
    Sanctum::actingAs(User::factory()->withRole(UserRole::Superadmin->value)->create());
    $target = User::factory()->create();
    $other = User::factory()->create();

    $this->putJson("/api/users/{$target->id}", ['email' => $other->email])
        ->assertStatus(422)
        ->assertJsonValidationErrors('email');
});

it('allows a user to keep their own email unchanged', function () {
    Sanctum::actingAs(User::factory()->withRole(UserRole::Superadmin->value)->create());
    $target = User::factory()->create(['email' => 'same@example.com']);

    $this->putJson("/api/users/{$target->id}", ['email' => 'same@example.com'])
        ->assertOk();
});
