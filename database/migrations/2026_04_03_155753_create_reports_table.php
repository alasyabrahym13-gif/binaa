<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
       Schema::create('reports', function (Blueprint $table) {
            $table->id();

            $table->foreignId('reporter_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->foreignId('reported_user_id')
                  ->constrained('users')
                  ->onDelete('cascade');
            $table->enum('category', [
                'spam',
                'harassment',
                'hate_speech',
                'fake_profile',
                'inappropriate_content',
                'scam',
                'other',
            ]);

            $table->string('reason', 255);

            $table->text('details')->nullable();

            $table->enum('status', [
                'pending',
                'under_review',
                'resolved',
                'dismissed',
            ])->default('pending');
            $table->foreignId('resolved_by')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('set null');

            $table->text('resolution_note')->nullable();

            $table->timestamp('resolved_at')->nullable();
            $table->softDeletes();

            // Indexes
            $table->index('reporter_id');
            $table->index('reported_user_id');
            $table->index('status');
            $table->index('category');
            $table->index('resolved_at');

            $table->unique(['reporter_id', 'reported_user_id']);
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
