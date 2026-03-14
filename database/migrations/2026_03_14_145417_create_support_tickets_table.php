<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('support_tickets', function (Blueprint $table) {

            $table->id();

            $table->string('name');
            $table->string('email');

            $table->string('subject');
            $table->text('message');

            // ticket status
            $table->enum('status', [
                'open',
                'in_progress',
                'resolved',
                'closed'
            ])->default('open');

            // admin assign
            $table->unsignedBigInteger('assigned_to')->nullable();

            // priority future use
            $table->enum('priority', [
                'low',
                'medium',
                'high'
            ])->default('medium');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_tickets');
    }
};
