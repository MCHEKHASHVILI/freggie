<?php

use App\Enums\UserRole;
use App\Filament\Pages\EditProfile;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

beforeEach(function () {
    $this->user = User::factory()->withRole(UserRole::Superadmin->value)->create();
    $this->actingAs($this->user);
});

it('does not expose an email field', function () {
    Livewire::test(EditProfile::class)
        ->assertFormFieldDoesNotExist('email');
});

it('updates the authenticated user\'s profile fields', function () {
    Livewire::test(EditProfile::class)
        ->fillForm([
            'profile' => [
                'name' => 'Nino',
                'surname' => 'Beridze',
                'phone' => '+995500000000',
            ],
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $profile = $this->user->fresh()->profile;

    expect($profile->name)->toBe('Nino')
        ->and($profile->surname)->toBe('Beridze')
        ->and($profile->phone)->toBe('+995500000000');
});

it('stores the uploaded avatar on the public disk so its url is reachable', function () {
    Storage::fake('public');

    Livewire::test(EditProfile::class)
        ->fillForm([
            'profile' => [
                'avatar' => UploadedFile::fake()->image('avatar.jpg'),
            ],
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    $media = $this->user->fresh()->profile->getFirstMedia('avatar');

    expect($media)->not->toBeNull()
        ->and($media->disk)->toBe('public');

    Storage::disk('public')->assertExists($media->getPathRelativeToRoot());
});
