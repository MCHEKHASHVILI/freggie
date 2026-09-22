<?php

use App\Models\User;

it('returns 401 when unauthenticated', function () {
    $this->postJson('/api/logout')->assertStatus(401);
});

it('revokes the token used to authenticate the request', function () {
    $user = User::factory()->create();
    $token = $user->createToken('test')->plainTextToken;

    $this->withHeader('Authorization', "Bearer {$token}")
        ->postJson('/api/logout')
        ->assertOk();

    expect($user->tokens()->count())->toBe(0);
});
