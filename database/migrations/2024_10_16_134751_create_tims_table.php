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
        Schema::create('tims', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('logo')->nullable();
            $table->integer('main')->default(0); // jumlah pertandingan
            $table->integer('menang')->default(0); // jumlah menang
            $table->integer('kalah')->default(0); // jumlah kalah
            $table->integer('set_main')->default(0); // jumlah set yang dimainkan
            $table->integer('set_menang')->default(0); // jumlah set menang
            $table->integer('set_kalah')->default(0); // jumlah set kalah
            $table->integer('skor')->default(0); // jumlah poin
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tims');
    }
};
