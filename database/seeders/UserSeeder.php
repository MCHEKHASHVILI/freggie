<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use RuntimeException;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's superadmin user from the credentials
     * configured via SUPERADMIN_EMAIL and SUPERADMIN_PASSWORD in .env.
     */
    public function run(): void
    {
        $email = config('superadmin.email');
        $password = config('superadmin.password');

        if (! $email || ! $password) {
            throw new RuntimeException(
                'SUPERADMIN_EMAIL and SUPERADMIN_PASSWORD must be set in .env before seeding users.'
            );
        }

        User::factory()
            ->withRole(UserRole::Superadmin->value)
            ->create([
                'email' => $email,
                'password' => $password,
            ]);
    }
}
