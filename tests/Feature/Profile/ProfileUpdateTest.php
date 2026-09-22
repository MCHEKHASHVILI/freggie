<?php

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;

it('requires authentication', function () {
    $this->putJson('/api/profile', ['name' => 'Nino'])->assertStatus(401);
});

it('updates the authenticated user\'s name, surname, and phone', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    $this->putJson('/api/profile', [
        'name' => 'Nino',
        'surname' => 'Beridze',
        'phone' => '+995500000000',
    ])
        ->assertOk()
        ->assertJsonPath('data.name', 'Nino')
        ->assertJsonPath('data.surname', 'Beridze')
        ->assertJsonPath('data.full_name', 'Nino Beridze')
        ->assertJsonPath('data.phone', '+995500000000');

    expect($user->fresh()->profile->name)->toBe('Nino');
});

it('only ever updates the authenticated user, ignoring any id in the payload', function () {
    $user = User::factory()->create();
    $other = User::factory()->create();
    Sanctum::actingAs($user);

    $this->putJson('/api/profile', [
        'id' => $other->id,
        'name' => 'Nino',
    ])->assertOk();

    expect($other->fresh()->profile->name)->toBeNull()
        ->and($user->fresh()->profile->name)->toBe('Nino');
});

it('uploads an avatar and returns its url', function () {
    Storage::fake('public');
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    $this->putJson('/api/profile', [
        'avatar' => UploadedFile::fake()->image('avatar.jpg'),
    ])->assertOk()->assertJsonPath('data.avatar_url', fn (?string $url) => filled($url));

    expect($user->fresh()->profile->getFirstMedia('avatar'))->not->toBeNull();
});

it('replaces the avatar on repeat uploads, keeping only one file', function () {
    Storage::fake('public');
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    $this->putJson('/api/profile', ['avatar' => UploadedFile::fake()->image('first.jpg')])->assertOk();
    $firstMediaId = $user->fresh()->profile->getFirstMedia('avatar')->id;

    $this->putJson('/api/profile', ['avatar' => UploadedFile::fake()->image('second.jpg')])->assertOk();
    $profile = $user->fresh()->profile;

    expect($profile->getMedia('avatar'))->toHaveCount(1)
        ->and($profile->getFirstMedia('avatar')->id)->not->toBe($firstMediaId);
});

it('rejects a non-image avatar', function () {
    Storage::fake('public');
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    $this->putJson('/api/profile', [
        'avatar' => UploadedFile::fake()->create('document.pdf', 100),
    ])->assertStatus(422)->assertJsonValidationErrors('avatar');
});

it('rejects an oversized avatar', function () {
    Storage::fake('public');
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    $this->putJson('/api/profile', [
        'avatar' => UploadedFile::fake()->image('avatar.jpg')->size(3000),
    ])->assertStatus(422)->assertJsonValidationErrors('avatar');
});
