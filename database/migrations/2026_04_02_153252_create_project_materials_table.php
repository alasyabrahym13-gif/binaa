<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
       Schema::create('project_materials', function (Blueprint $table) {
    $table->id();

    $table->foreignId('project_id')
          ->constrained('client_projects')
          ->onDelete('cascade');

    $table->foreignId('product_id')
          ->constrained('products')
          ->onDelete('cascade');

    $table->unsignedInteger('quantity');
    $table->unsignedDecimal('price', 10, 2);
    $table->unsignedDecimal('unit_price', 10, 2)->nullable()->comment('سعر الوحدة قبل التعديل');
    $table->unsignedDecimal('total_price', 10, 2)->storedAs('quantity * price');

    $table->string('notes', 500)->nullable();
    $table->tinyInteger('status')->default(1)->comment('1=active, 0=inactive');

    $table->unsignedBigInteger('created_by')->nullable();
    $table->unsignedBigInteger('updated_by')->nullable();

    $table->foreign('created_by')->references('id')->on('users')->nullOnDelete();
    $table->foreign('updated_by')->references('id')->on('users')->nullOnDelete();

    $table->softDeletes();

    $table->unique(['project_id', 'product_id']);
    $table->index(['project_id', 'status']);
});
    }
    public function down(): void
    {
        Schema::dropIfExists('project_materials');
    }
};
