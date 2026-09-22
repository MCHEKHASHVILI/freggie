<?php

use App\Enums\UserRole;
use App\Models\User;

it('redirects unauthenticated visitors to the login page', function () {
    $this->get('/admin')->assertRedirect('/admin/login');
});

it('forbids an active user without the superadmin role', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->get('/admin')->assertForbidden();
});

it('forbids an inactive superadmin', function () {
    $user = User::factory()->inactive()->withRole(UserRole::Superadmin->value)->create();

    $this->actingAs($user)->get('/admin')->assertForbidden();
});

it('allows an active superadmin', function () {
    $user = User::factory()->withRole(UserRole::Superadmin->value)->create();

    $this->actingAs($user)->get('/admin')->assertOk();
});
