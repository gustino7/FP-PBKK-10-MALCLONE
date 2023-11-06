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
        Schema::create('anime_staff', function (Blueprint $table) {
            $table->unsignedBigInteger('anime_id')->nullable(false);
            $table->unsignedBigInteger('staff_id')->nullable(false);
            $table->timestamps();

            $table->foreign('anime_id')->references('id')->on('animes')->cascadeOnDelete();
            $table->foreign('staff_id')->references('id')->on('staff')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anime__staff');
    }
};
