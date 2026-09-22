<?php

use App\Enums\UserRole;
use App\Models\User;

it('shows a language switcher in the admin panel topbar', function () {
    $user = User::factory()->withRole(UserRole::Superadmin->value)->create();

    $this->actingAs($user)->get('/admin')
        ->assertOk()
        ->assertSee('ქართული');
});

it('switches the authenticated user\'s locale and redirects back', function () {
    $user = User::factory()->withRole(UserRole::Superadmin->value)->create(['locale' => 'en']);

    $this->actingAs($user)
        ->from('/admin')
        ->get('/admin/locale/ka')
        ->assertRedirect('/admin');

    expect($user->fresh()->locale)->toBe('ka');
});

it('rejects an unsupported locale', function () {
    $user = User::factory()->withRole(UserRole::Superadmin->value)->create();

    $this->actingAs($user)->get('/admin/locale/fr')->assertNotFound();
});

it('requires authentication to switch locale', function () {
    $this->get('/admin/locale/ka')->assertStatus(302);

    $this->assertGuest();
});
