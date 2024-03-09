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
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->String('status');
            $table->double('merchandise_fee', 8, 2);
            $table->double('shipping_fee', 8, 2);
            $table->double('total_amount', 8, 2);
            $table->String('address');
            $table->String('is_separate')->default(false);
            $table->longText('note')->nullable();
            $table->String('name')->nullable();
            $table->String('address')->nullable();
            $table->String('contact_number')->nullable();
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
        Schema::dropIfExists('order');
    }
};
