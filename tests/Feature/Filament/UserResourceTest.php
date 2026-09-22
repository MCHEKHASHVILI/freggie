<?php

use App\Enums\UserRole;
use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;

beforeEach(function () {
    $this->admin = User::factory()->withRole(UserRole::Superadmin->value)->create();
    $this->actingAs($this->admin);
});

it('lists existing users', function () {
    $other = User::factory()->create();

    Livewire::test(ListUsers::class)
        ->assertCanSeeTableRecords([$this->admin, $other]);
});

it('creates a user with a hashed password and assigned roles', function () {
    $adminRoleId = Role::where('name', UserRole::Admin->value)->firstOrFail()->getKey();

    Livewire::test(CreateUser::class)
        ->fillForm([
            'email' => 'new@example.com',
            'password' => 'password',
            'is_active' => true,
            'roles' => [$adminRoleId],
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $user = User::where('email', 'new@example.com')->first();

    expect($user)->not->toBeNull()
        ->and(Hash::check('password', $user->password))->toBeTrue()
        ->and($user->hasRole(UserRole::Admin->value))->toBeTrue();
});

it('updates an existing user email', function () {
    $target = User::factory()->create();

    Livewire::test(EditUser::class, ['record' => $target->getRouteKey()])
        ->fillForm(['email' => 'updated@example.com'])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($target->fresh()->email)->toBe('updated@example.com');
});

it('disables the active toggle when editing your own account', function () {
    Livewire::test(EditUser::class, ['record' => $this->admin->getRouteKey()])
        ->assertFormFieldDisabled('is_active');
});

it('hides the delete action on your own account', function () {
    Livewire::test(EditUser::class, ['record' => $this->admin->getRouteKey()])
        ->assertActionHidden('delete');
});

it('deletes another user from the edit page', function () {
    $target = User::factory()->create();

    Livewire::test(EditUser::class, ['record' => $target->getRouteKey()])
        ->callAction('delete');

    $this->assertDatabaseMissing('users', ['id' => $target->id]);
});
