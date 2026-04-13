<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('client_projects', function (Blueprint $table) {
            $table->id();
             $table->foreignId('client_id')
          ->constrained('users')
          ->cascadeOnDelete();

    $table->string('title', 150);
    $table->string('type');
    $table->text('description')->nullable();
    $table->string('status', 30)->default('pending');
    $table->timestamp('started_at')->nullable();
    $table->timestamp('completed_at')->nullable();
    $table->softDeletes();
    
});
    }
    public function down(): void
    {
        Schema::dropIfExists('client_projects');
    }
};
