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
        Schema::create('tandings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tim1_id')->constrained('tims');
            $table->foreignId('tim2_id')->constrained('tims');
            $table->integer('tim1_skor');
            $table->integer('tim2_skor');
            $table->integer('tim1_set_menang');
            $table->integer('tim2_set_menang');
            $table->json('tim1_set_skor'); // Skor setiap set tim 1
            $table->json('tim2_set_skor'); // Skor setiap set tim 2
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tandings');
    }
};
