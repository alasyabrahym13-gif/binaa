<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
       Schema::create('reviews', function (Blueprint $table) {
            $table->id();

            $table->foreignId('reviewer_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->foreignId('reviewed_user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->tinyInteger('rating')->unsigned();

            $table->string('title', 100)->nullable();

            $table->text('comment')->nullable();

            $table->enum('status', ['pending', 'approved', 'rejected'])
                  ->default('pending');

            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('reviewer_id');
            $table->index('reviewed_user_id');
            $table->index('status');

            // Prevent duplicate reviews from same user
            $table->unique(['reviewer_id', 'reviewed_user_id']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
