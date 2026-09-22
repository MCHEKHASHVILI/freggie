<?php

use App\Enums\UserRole;
use App\Models\User;

it('shows the georgian resource labels', function () {
    $admin = User::factory()->withRole(UserRole::Superadmin->value)->create(['locale' => 'ka']);

    $this->actingAs($admin)->get('/admin')
        ->assertOk()
        ->assertSee('მომხმარებლები');

    $this->actingAs($admin)->get('/admin/users/create')
        ->assertOk()
        ->assertSee('მომხმარებელი');
});

it('shows the correct georgian phrasing for the create user page title', function () {
    $admin = User::factory()->withRole(UserRole::Superadmin->value)->create(['locale' => 'ka']);

    $this->actingAs($admin)->get('/admin/users/create')
        ->assertOk()
        ->assertSee('ახალი მომხმარებელი')
        ->assertDontSee('ქმნით მომხმარებელი');
});

it('translates each role label to georgian', function () {
    app()->setLocale('ka');

    expect(UserRole::Superadmin->getLabel())->toBe('სუპერ ადმინი')
        ->and(UserRole::Admin->getLabel())->toBe('ადმინისტრატორი')
        ->and(UserRole::Director->getLabel())->toBe('დირექტორი')
        ->and(UserRole::Manager->getLabel())->toBe('მენეჯერი')
        ->and(UserRole::Courier->getLabel())->toBe('კურიერი');
});

it('shows the georgian role label as a badge in the users table', function () {
    $admin = User::factory()->withRole(UserRole::Superadmin->value)->create(['locale' => 'ka']);
    User::factory()->withRole(UserRole::Courier->value)->create();

    $this->actingAs($admin)->get('/admin/users')
        ->assertOk()
        ->assertSee('კურიერი');
});

it('shows the georgian field labels on the create user page', function () {
    $admin = User::factory()->withRole(UserRole::Superadmin->value)->create(['locale' => 'ka']);

    $this->actingAs($admin)->get('/admin/users/create')
        ->assertOk()
        ->assertSee('ელ. ფოსტა')
        ->assertSee('პაროლი')
        ->assertSee('აქტიური')
        ->assertSee('როლები');
});

it('shows the georgian field labels on the users table', function () {
    $admin = User::factory()->withRole(UserRole::Superadmin->value)->create(['locale' => 'ka']);

    $this->actingAs($admin)->get('/admin/users')
        ->assertOk()
        ->assertSee('ელ. ფოსტა')
        ->assertSee('აქტიური')
        ->assertSee('როლები');
});
