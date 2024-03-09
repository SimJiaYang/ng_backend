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
        Schema::create('payment', function (Blueprint $table) {
            $table->id();
            $table->String('status');
            $table->double('amount', 8, 2);
            $table->String('method');
            $table->String('details');
            $table->foreignId('order_id')->nullable();
            $table->foreign('order_id')->references('id')->on('order');
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
        Schema::dropIfExists('payment');
    }
};
