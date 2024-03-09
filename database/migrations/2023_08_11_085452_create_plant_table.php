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
        Schema::create('plant', function (Blueprint $table) {
            $table->id();
            $table->String('name');
            $table->double('price', 8, 2);
            $table->longText('description');
            $table->integer('quantity');
            $table->String('image');
            $table->integer('sales_amount')->nullable();
            $table->String('placement');
            $table->String('temperature');
            $table->String('water_need');
            $table->String('sunlight_need');
            $table->String('height');
            $table->String('size');
            $table->double('weight', 8, 2);
            $table->String('origin');
            $table->longText('other')->nullable();
            $table->String('pot_name')->nullable();
            $table->String('pot_size')->nullable();
            $table->String('experience');
            $table->String('status')->default(true);
            $table->foreignId('category_id')->constrained('category');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plant');
    }
};
