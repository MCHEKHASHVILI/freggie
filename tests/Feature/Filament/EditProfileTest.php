<?php

use App\Enums\UserRole;
use App\Filament\Pages\EditProfile;
use App\Models\User;
use Livewire\Livewire;

beforeEach(function () {
    $this->user = User::factory()->withRole(UserRole::Superadmin->value)->create();
    $this->actingAs($this->user);
});

it('updates the authenticated user\'s locale', function () {
    Livewire::test(EditProfile::class)
        ->fillForm(['locale' => 'ka'])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($this->user->fresh()->locale)->toBe('ka');
});

it('rejects an unsupported locale', function () {
    Livewire::test(EditProfile::class)
        ->fillForm(['locale' => 'fr'])
        ->call('save')
        ->assertHasFormErrors(['locale']);
});
