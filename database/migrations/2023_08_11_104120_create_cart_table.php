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
            $table->double('price', 8, 2);
            $table->date('date_added');
            $table->string('is_purchase')->default('false');
            $table->foreignId('product_id')->nullable();
            $table->foreignId('plant_id')->nullable();
            $table->foreignId('bidding_id')->nullable();
            $table->foreignId('user_id');
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
