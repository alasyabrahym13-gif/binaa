<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('engineerprofiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('specialization', 150)->index();

            $table->unsignedTinyInteger('experience_years')
                ->default(0)
                ->comment('Years of experience');
            $table->json('certificates')->nullable();

            $table->text('bio')->nullable();
            $table->boolean('is_available')
                ->default(true)
                ->index();

            $table->decimal('rating', 3, 2)
                ->default(0.00);
                
            $table->softDeletes();

            $table->unique('user_id'); 
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('engineerprofiles');
    }
};
