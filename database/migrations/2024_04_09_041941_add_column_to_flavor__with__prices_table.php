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
        Schema::table('flavor__with__prices', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('flavor_id')->after('flavor_price');
            $table->foreign('flavor_id')->references('flavor_id')->on('flavor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('flavor__with__prices', function (Blueprint $table) {
            //
        });
    }
};
