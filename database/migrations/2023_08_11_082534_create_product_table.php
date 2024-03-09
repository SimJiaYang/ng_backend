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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->String('name');
            $table->double('price', 8, 2);
            $table->longText('description');
            $table->integer('quantity');
            $table->String('image');
            $table->integer('sales_amount')->nullable();
            $table->String('material')->nullable();
            $table->double('length', 8, 2)->nullable();
            $table->String('size')->nullable();
            $table->double('weight', 8, 2);
            $table->longText('other')->nullable();
            $table->String('status')->default(true);
            $table->foreignId('category_id')->constrained('category');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
