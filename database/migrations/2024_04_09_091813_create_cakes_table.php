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
        Schema::create('cakes', function (Blueprint $table) {
            $table->id();
           
            $table->string("cakename");
            $table->integer("productId");
            $table->string("category_name");
            $table->json("subcategory_ids"); //multiple
            $table->json("images");  //multiple
            $table->json("tag_ids"); //multiple
            $table->json("cake_size_with_prices_ids"); //multiple 
            $table->json("flavor_with_prices_ids"); //multiple
            $table->integer("discount")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cakes');
    }
};
