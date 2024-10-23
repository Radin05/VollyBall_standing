<?php

namespace App\Models;

use App\Models\Matche;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name', 'played',
        'won', 'lost',
        'sets_played',
        'sets_won', 'sets_lost',
        'points'];

    public function matchesAsTeam1()
    {
        return $this->hasMany(Matche::class, 'team1_id');
    }

    public function matchesAsTeam2()
    {
        return $this->hasMany(Matche::class, 'team2_id');
    }
    public function getTotalPointsScored()
    {
        $totalPoints = 0;

        // Hitung poin ketika tim menjadi Team 1
        foreach ($this->matchesAsTeam1 as $match) {
            $totalPoints += array_sum($match->team1_set_scores);
        }

        // Hitung poin ketika tim menjadi Team 2
        foreach ($this->matchesAsTeam2 as $match) {
            $totalPoints += array_sum($match->team2_set_scores);
        }

        return $totalPoints;
    }

    // Fungsi untuk menghitung total poin yang kemasukan oleh tim (poin lawan)
    public function getTotalPointsAgainst()
    {
        $totalPointsAgainst = 0;

        // Hitung poin kemasukan ketika tim menjadi Team 1
        foreach ($this->matchesAsTeam1 as $match) {
            $totalPointsAgainst += array_sum($match->team2_set_scores);
        }

        // Hitung poin kemasukan ketika tim menjadi Team 2
        foreach ($this->matchesAsTeam2 as $match) {
            $totalPointsAgainst += array_sum($match->team1_set_scores);
        }

        return $totalPointsAgainst;
    }

    public function getPointDifferenceAttribute()
    {
        return $this->getTotalPointsScored() - $this->getTotalPointsAgainst();
    }

    // Fungsi untuk menghitung selisih set menang dan set kalah
    public function getSetDifferenceAttribute()
    {
        return $this->sets_won - $this->sets_lost;
    }

}
