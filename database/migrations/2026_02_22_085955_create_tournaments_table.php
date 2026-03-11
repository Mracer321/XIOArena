<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('organization_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('title');
            $table->string('slug')->unique();

            $table->string('poster')->nullable();

            $table->integer('prize_pool')->default(0);

            $table->string('entry_type')->default('free');
            $table->string('registration_status')->default('open');

            $table->text('description')->nullable();

            $table->timestamps();;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournaments');
    }
};
