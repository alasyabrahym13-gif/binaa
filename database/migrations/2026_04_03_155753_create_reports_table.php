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
       Schema::create('reports', function (Blueprint $table) {
            $table->id();

            $table->foreignId('reporter_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->foreignId('reported_user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            // The category of violation being reported
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

            // The admin who handled this report
            $table->foreignId('resolved_by')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('set null');

            $table->text('resolution_note')->nullable();

            $table->timestamp('resolved_at')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('reporter_id');
            $table->index('reported_user_id');
            $table->index('status');
            $table->index('category');
            $table->index('resolved_at');

            // One active report per user pair (ignore dismissed/resolved duplicates via partial index workaround)
            $table->unique(['reporter_id', 'reported_user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
