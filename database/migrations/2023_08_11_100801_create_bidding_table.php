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
        Schema::create('bidding', function (Blueprint $table) {
            $table->id();
            $table->string('history')->nullable();
            $table->double('min_amount', 8, 2);
            $table->string('status');
            $table->string('message');
            $table->foreignId('winner')->nullable();
            $table->double('win_amount', 8, 2)->nullable();
            $table->timestamp('start_time', $precision = 0);
            $table->timestamp('end_time', $precision = 0)->nullable();
            $table->foreignId('plant_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bidding');
    }
};
