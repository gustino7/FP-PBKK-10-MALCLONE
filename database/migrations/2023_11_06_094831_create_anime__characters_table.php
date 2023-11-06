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
        Schema::create('anime_characters', function (Blueprint $table) {
            $table->unsignedBigInteger('anime_id')->nullable(false);
            $table->unsignedBigInteger('character_id')->nullable(false);
            $table->timestamps();

            $table->foreign('anime_id')->references('id')->on('animes')->cascadeOnDelete();
            $table->foreign('character_id')->references('id')->on('characters')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anime__characters');
    }
};
