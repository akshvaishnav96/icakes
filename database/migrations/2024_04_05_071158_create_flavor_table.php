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
        Schema::create('flavor', function (Blueprint $table) {
            $table->id('flavor_id');
            $table->string("flavor_name");
            $table->text("flavor_description");
            $table->text("flavor_ingredients");
            $table->string("flavor_image");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flavor');
    }
};
