<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('creators', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('slug')->unique();

            $table->string('profile_image')->nullable();
            $table->text('bio')->nullable();

            $table->string('youtube')->nullable();
            $table->string('instagram')->nullable();
            $table->string('discord')->nullable();

            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();

            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);

            $table->timestamps();
        });

        Schema::create('creator_games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('creator_id')->constrained()->onDelete('cascade');
            $table->string('game_name');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('creator_games');
        Schema::dropIfExists('creators');
    }
};
