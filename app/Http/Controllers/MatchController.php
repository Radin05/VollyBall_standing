<?php

namespace App\Http\Controllers;

use App\Models\Matche;
use App\Models\Team;
use Illuminate\Http\Request;

class MatchController extends Controller
{

    public function index()
    {
        // Ambil semua pertandingan dari database
        $matches = Matche::with(['team1', 'team2'])->get();

        // Kirim data pertandingan ke view
        return view('match.index', compact('matches'));
    }

    public function create()
    {
        // Ambil semua tim untuk ditampilkan di dropdown
        $teams = Team::all();
        $mathces = Matche::all();

        // Tampilkan view dengan data tim
        return view('match.create', compact('teams', 'mathces'));
    }

    public function store(Request $request)
    {
        // Validasi input
        // $request->validate([
        //     'team1_id' => 'required|exists:teams,id',
        //     'team2_id' => 'required|exists:teams,id',
        //     'team1_sets_won' => 'required|integer',
        //     'team2_sets_won' => 'required|integer',
        //     'team1_set_scores' => 'required|array',
        //     'team2_set_scores' => 'required|array',
        //     'team1_set_scores.*' => 'integer',
        //     'team2_set_scores.*' => 'integer',
        // ]);

        $match = Matche::create([
            'team1_id' => $request->team1_id,
            'team2_id' => $request->team2_id,
            'team1_score' => $request->team1_score,
            'team2_score' => $request->team2_score,
            'team1_sets_won' => $request->team1_sets_won,
            'team2_sets_won' => $request->team2_sets_won,
            'team1_set_scores' => $request->team1_set_scores,
            'team2_set_scores' => $request->team2_set_scores,
        ]);

        // Perbarui klasemen
        $match->updateStandings();

        return redirect()->route('team.index')->with('success', 'Pertandingan telah disimpan dan klasemen diperbarui.');
    }

    

    public function destroy($id)
    {
        // Temukan pertandingan berdasarkan ID
        $match = Matche::findOrFail($id);

        // Dapatkan tim yang terlibat dalam pertandingan
        $team1 = $match->team1; // Tim 1
        $team2 = $match->team2; // Tim 2

        // Kurangi statistik untuk Tim 1 dan Tim 2

        // 1. Update jumlah pertandingan yang dimainkan
        $team1->played -= 1;
        $team2->played -= 1;

        // 2. Periksa siapa yang memenangkan pertandingan, dan perbarui statistik menang/kalah
        if ($match->team1_sets_won > $match->team2_sets_won) {
            // Jika Tim 1 menang
            $team1->won -= 1; // Kurangi jumlah kemenangan Tim 1
            $team2->lost -= 1; // Kurangi jumlah kekalahan Tim 2
        } elseif ($match->team2_sets_won > $match->team1_sets_won) {
            // Jika Tim 2 menang
            $team2->won -= 1; // Kurangi jumlah kemenangan Tim 2
            $team1->lost -= 1; // Kurangi jumlah kekalahan Tim 1
        }

        // 3. Update jumlah set menang dan set kalah
        $team1->sets_won -= $match->team1_sets_won;
        $team1->sets_lost -= $match->team2_sets_won;

        $team2->sets_won -= $match->team2_sets_won;
        $team2->sets_lost -= $match->team1_sets_won;

        // 4. Update poin (kurangi poin, pastikan poin tidak negatif)
        $team1_total_points = array_sum($match->team1_set_scores); // Total poin yang dicetak oleh Tim 1
        $team2_total_points = array_sum($match->team2_set_scores); // Total poin yang dicetak oleh Tim 2

        // Pastikan poin tidak menjadi negatif
        $team1->points = max(0, $team1->points - $team1_total_points);
        $team2->points = max(0, $team2->points - $team2_total_points);

        // 5. Simpan perubahan pada kedua tim
        $team1->save();
        $team2->save();

        // 6. Hapus pertandingan
        $match->delete();

        // Redirect ke halaman match.index dengan pesan sukses
        return redirect()->route('match.index')
            ->with('success', 'Pertandingan dan statistik tim berhasil diperbarui dan dihapus.');
    }

}
