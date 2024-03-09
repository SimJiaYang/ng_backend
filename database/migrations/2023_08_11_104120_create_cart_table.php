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
        Schema::create('cart', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->double('unit_price', 8, 2);
            $table->String('is_purchase')->default(false);
            $table->foreignId('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('product');
            $table->foreignId('plant_id')->nullable();
            $table->foreign('plant_id')->references('id')->on('plant');
            $table->foreignUuid('user_id')->constrained();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart');
    }
};
