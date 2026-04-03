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
        Schema::create('products', function (Blueprint $table) {

    $table->id();

    $table->foreignId('supplier_id')
          ->constrained('users')
          ->onDelete('cascade');

    $table->string('name', 255)->index();
    $table->string('slug')->unique();
    $table->text('description')->nullable();
    $table->string('category', 100)->index();

    $table->decimal('price', 10, 2)->default(0.00);
    $table->unsignedInteger('quantity')->default(0);
    $table->unsignedInteger('min_stock_alert')->default(5);

    $table->enum('status', ['active', 'inactive', 'out_of_stock'])
          ->default('active');

    $table->boolean('is_featured')->default(false);
    $table->string('image')->nullable();

    $table->timestamps();
    $table->softDeletes();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
