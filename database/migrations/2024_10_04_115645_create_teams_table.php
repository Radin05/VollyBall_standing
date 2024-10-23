<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cover')->nullable();
            $table->integer('played')->default(0); // jumlah pertandingan
            $table->integer('won')->default(0); // jumlah menang
            $table->integer('lost')->default(0); // jumlah kalah
            $table->integer('sets_played')->default(0); // jumlah set yang dimainkan
            $table->integer('sets_won')->default(0); // jumlah set menang
            $table->integer('sets_lost')->default(0); // jumlah set kalah
            $table->integer('points')->default(0); // jumlah poin
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
