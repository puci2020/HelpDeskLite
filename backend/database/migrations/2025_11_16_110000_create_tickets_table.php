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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('description')->nullable();

            // Priority: low, medium, high
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');

            // Status: open, in_progress, resolved, closed
            $table->enum('status', ['open', 'in_progress', 'resolved', 'closed'])->default('open');

            // Assignee: nullable, bo ticket może nie być przypisany
            $table->foreignId('assignee_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Kto stworzył ticket?
            $table->foreignId('reporter_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
