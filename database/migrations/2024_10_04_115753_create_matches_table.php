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
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team1_id')->constrained('teams');
            $table->foreignId('team2_id')->constrained('teams');
            $table->integer('team1_score');
            $table->integer('team2_score');
            $table->integer('team1_sets_won');
            $table->integer('team2_sets_won');
            $table->json('team1_set_scores'); // Skor setiap set tim 1
            $table->json('team2_set_scores'); // Skor setiap set tim 2
            $table->timestamps();

            // $table->foreign('team_a_id')->references('id')->on('teams')->onDelete('cascade');
            // $table->foreign('team_b_id')->references('id')->on('teams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matches');
    }
};
