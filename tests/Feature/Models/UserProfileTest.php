<?php

use App\Models\User;

it('automatically creates an empty profile when a user is created', function () {
    $user = User::factory()->create();

    expect($user->profile)->not->toBeNull()
        ->and($user->profile->name)->toBeNull()
        ->and($user->profile->surname)->toBeNull()
        ->and($user->profile->phone)->toBeNull();
});

it('builds the full name from the profile', function () {
    $user = User::factory()->create();
    $user->profile->update(['name' => 'Nino', 'surname' => 'Beridze']);

    expect($user->fresh()->fullName())->toBe('Nino Beridze');
});

it('falls back to the email when the profile has no name', function () {
    $user = User::factory()->create(['email' => 'nobody@example.com']);

    expect($user->fullName())->toBe('nobody@example.com');
});

it('returns null for the avatar url when no avatar has been uploaded', function () {
    $user = User::factory()->create();

    expect($user->profile->avatarUrl())->toBeNull();
});
