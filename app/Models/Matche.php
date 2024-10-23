<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matche extends Model
{
    protected $fillable = [
        'team1_id', 'team2_id',
        'team1_score', 'team2_score',
        'team1_sets_won', 'team2_sets_won',
        'team1_set_scores', 'team2_set_scores',
    ];

    protected $casts = [
        'team1_set_scores' => 'array',
        'team2_set_scores' => 'array',
    ];
    public function team1()
    {
        return $this->belongsTo(Team::class, 'team1_id');
    }

    public function team2()
    {
        return $this->belongsTo(Team::class, 'team2_id');
    }

    // Fungsi untuk menghitung total skor tim 1
    public function getTotalScoreTeam1()
    {
        return array_sum($this->team1_set_scores);
    }

    // Fungsi untuk menghitung total skor tim 2
    public function getTotalScoreTeam2()
    {
        return array_sum($this->team2_set_scores);
    }

    public function updateStandings()
    {
        $team1 = $this->team1;
        $team2 = $this->team2;

        // Tambahkan jumlah pertandingan yang dimainkan
        $team1->played += 1;
        $team2->played += 1;

        // Tambahkan jumlah set yang dimainkan
        $team1->sets_played += $this->team1_sets_won + $this->team2_sets_won; // Total set yang dimainkan oleh team1
        $team2->sets_played += $this->team1_sets_won + $this->team2_sets_won; // Total set yang dimainkan oleh team2

        // Cek siapa yang menang
        if ($this->team1_score > $this->team2_score) {
            $team1->won += 1;
            $team2->lost += 1;
            $team1->points += 1; // Misalnya 3 poin untuk kemenangan
        } elseif ($this->team1_score < $this->team2_score) {
            $team2->won += 1;
            $team1->lost += 1;
            $team2->points += 1;
        }

        // Tambahkan jumlah set yang dimenangkan dan kalah
        $team1->sets_won += $this->team1_sets_won;
        $team1->sets_lost += $this->team2_sets_won;

        $team2->sets_won += $this->team2_sets_won;
        $team2->sets_lost += $this->team1_sets_won;

        // Simpan perubahan
        $team1->save();
        $team2->save();
    }
}
