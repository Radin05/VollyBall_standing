<?php

namespace App\Exports;

use App\Models\Team;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ExportTeam implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function View():View
    {
        $teams = Team::with('matchesAsTeam1', 'matchesAsTeam2')
            ->get()
            ->sortByDesc(function ($team) {
                // Urutkan berdasarkan kemenangan, selisih poin, poin tertinggi, set menang, dan set kalah
                return [
                    $team->won, // Urutkan berdasarkan jumlah kemenangan
                    $team->set_difference, // Lalu urutkan berdasarkan selisih set
                    $team->point_difference, // Lalu urutkan berdasarkan selisih poin
                    $team->points, // Urutkan berdasarkan poin tertinggi
                    $team->sets_won, // Jika poin sama, urutkan berdasarkan set menang
                    $team->sets_lost, // Urutkan berdasarkan sedikit set kalah (gunakan minus agar urutan asc)
                ];
            });

        return view('team.table', ['teams'=>$teams]);
    }
}
