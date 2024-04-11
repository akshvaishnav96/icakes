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
        Schema::create('cake_size_with_prices', function (Blueprint $table) {
            $table->id("cake_size_with_prices_id");
            $table->unsignedBigInteger("tier_id");
            $table->unsignedBigInteger("size_id");
            $table->foreign('tier_id')->references('tier_id')->on('tiers');
            $table->foreign('size_id')->references('size_id')->on('size');
            $table->float('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cake_size_with_prices');
    }
};
