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
            $table->double('unit_price', 8, 2);
            $table->double('total_amount', 8, 2);
            $table->String('remark')->default('true');
            $table->foreignId('order_id');
            $table->foreign('order_id')->references('id')->on('order');
            $table->foreignId('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('product');
            $table->foreignId('plant_id')->nullable();
            $table->foreign('plant_id')->references('id')->on('plant');
            $table->foreignId('delivery_id')->nullable();
            $table->foreign('delivery_id')->references('id')->on('delivery');
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
