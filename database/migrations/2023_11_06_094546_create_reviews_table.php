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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->text('comment')->nullable(false);
            $table->string('feelings')->nullable(false);
            $table->integer('likes')->default(0);
            $table->decimal('rating')->default(0);
            $table->string('status')->default('watching'); //watching, completed, plan to watch

            $table->uuid('user_id')->nullable(false);
            $table->unsignedBigInteger('anime_id')->nullable(false);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('anime_id')->references('id')->on('animes')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
