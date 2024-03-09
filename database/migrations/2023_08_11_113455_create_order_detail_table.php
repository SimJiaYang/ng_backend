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
            $table->foreignId('order_id')->constrained('order');
            $table->foreignId('product_id')->nullable()->constrained('product');
            $table->foreignId('plant_id')->nullable()->constrained('plant');
            $table->foreignId('delivery_id')->nullable()->constrained('delivery');
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
