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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string("location_name");
            $table->text("location_content");
            $table->string("location_address");
            $table->string("location_postal");
            $table->string("location_city");
            $table->double("location_lat")->nullable();
            $table->double("location_lng")->nullable();
            $table->timestamps();

            $table->foreignId("category_id")->on("categories")->constrained();
            $table->foreignId("user_id")->on("users")->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
