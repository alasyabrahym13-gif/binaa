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
       Schema::create('messages', function (Blueprint $table) {
            $table->id();

            $table->foreignId('sender_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->foreignId('receiver_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->text('body');

            $table->enum('type', ['text', 'image', 'file', 'audio'])->default('text');

            $table->timestamp('read_at')->nullable();
            $table->timestamp('deleted_at')->nullable(); // Soft delete per user

            $table->timestamps();

            // Indexes for performance
            $table->index(['sender_id', 'receiver_id']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
