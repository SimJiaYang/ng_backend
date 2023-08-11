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
        Schema::create('order_detail', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->double('price', 8, 2);
            $table->double('amount', 8, 2);
            $table->foreignId('order_id');
            $table->foreignId('cart_id')->nullable();
            $table->foreignId('product_id')->nullable();
            $table->foreignId('plant_id')->nullable();
            $table->foreignId('bidding_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_detail');
    }
};
