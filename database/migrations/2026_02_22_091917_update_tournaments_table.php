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

            if (!Schema::hasColumn('tournaments', 'poster')) {
                $table->string('poster')->nullable()->after('slug');
            }

            if (!Schema::hasColumn('tournaments', 'total_slots')) {
                $table->integer('total_slots')->default(0)->after('prize_pool');
            }

            if (!Schema::hasColumn('tournaments', 'about')) {
                $table->text('about')->nullable()->after('description');
            }

            if (!Schema::hasColumn('tournaments', 'additional_images')) {
                $table->json('additional_images')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tournaments', function (Blueprint $table) {

            $table->dropColumn([
                'poster',
                'total_slots',
                'about',
                'additional_images'
            ]);
        });
    }
};
