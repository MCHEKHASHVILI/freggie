<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();
        });

        // Every user is expected to have a profile (see User::booted()); that
        // guarantee only covers users created from here on, so backfill one
        // for every user that already exists.
        $now = now();

        DB::table('users')
            ->select('id')
            ->orderBy('id')
            ->chunkById(500, function ($users) use ($now) {
                DB::table('user_profiles')->insert($users->map(fn ($user) => [
                    'user_id' => $user->id,
                    'created_at' => $now,
                    'updated_at' => $now,
                ])->all());
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
