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
        Schema::create('delivery', function (Blueprint $table) {
            $table->id();
            $table->String('tracking_number')->nullable();
            $table->String('courier')->nullable();
            $table->String('method')->nullable();
            $table->String('status');
            $table->String('delivered_img')->nullable();
            $table->date('expected_date')->nullable();
            $table->foreignUuid('user_id')->constrained('users');
            $table->foreignId('order_id')->constrained('order');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery');
    }
};
