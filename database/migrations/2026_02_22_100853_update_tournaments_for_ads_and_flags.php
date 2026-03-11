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
        Schema::table('tournaments', function (Blueprint $table) {

            // Tournament Type
            $table->string('type')->default('online');
            // online / offline

            // Featured / Sponsored
            $table->boolean('is_featured')->default(false);

            $table->timestamp('featured_until')->nullable();

            // Ads style priority (placement)
            $table->integer('priority')->default(0);

            // Visibility control
            $table->boolean('is_visible')->default(true);

            // Flags
            $table->boolean('is_scammed')->default(false);
            $table->boolean('pp_pending')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
