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
        Schema::create('anime_studios', function (Blueprint $table) {
            $table->unsignedBigInteger('anime_id')->nullable(false);
            $table->unsignedBigInteger('studio_id')->nullable(false);
            $table->timestamps();

            $table->foreign('anime_id')->references('id')->on('animes')->cascadeOnDelete();
            $table->foreign('studio_id')->references('id')->on('studios')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anime__studios');
    }
};
