<?php

namespace App\Http\Controllers;

use App\Exports\ExportTeam;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Team;
use App\Models\Tim;
use Mpdf\Mpdf;

class TeamController extends Controller
{
    public function index()
    {
        // Ambil semua tim beserta data pertandingan yang relevan
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

        // Kembalikan view dengan data tim yang diurutkan
        return view('team.index', compact('teams'));
    }

    public function view_pdf()
    {
        // Inisialisasi mPDF
        $mpdf = new \Mpdf\Mpdf([
            'memory_limit' => '512M',
            'tempDir' => __DIR__ . '/tmp', // Set temp directory jika diperlukan
            'setAutoTopMargin' => 'stretch', // Agar margin otomatis menyesuaikan gambar besar
            'allow_output_buffering' => true, // Untuk menghindari kesalahan output buffering
        ]);

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

        $tims = Tim::with('tandingsAsTim1', 'tandingsAsTim2')
            ->get()
            ->sortByDesc(function ($tim) {
                // Urutkan berdasarkan kemenangan, selisih poin, poin tertinggi, set menang, dan set kalah
                return [
                    $tim->menang,
                    $tim->set_difference,
                    $tim->skor_difference,
                    $tim->skor,
                    $tim->set_menang,
                    $tim->set_kalah
                ];
            });
        // Render view menjadi string HTML khusus untuk PDF
        $htmlContent = view('team.pdf', compact('teams', 'tims'))->render();

        // Tulis konten HTML ke dalam PDF menggunakan mPDF
        $mpdf->WriteHTML($htmlContent);

        // Output PDF ke browser
        $mpdf->Output();
    }

    public function download_pdf()
    {
        $mpdf = new Mpdf([
            'memory_limit' => '512M',
            'tempDir' => __DIR__ . '/tmp', // Set temp directory jika diperlukan
            'setAutoTopMargin' => 'stretch', // Agar margin otomatis menyesuaikan gambar besar
            'allow_output_buffering' => true, // Untuk menghindari kesalahan output buffering
        ]);

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

            $tims = Tim::with('tandingsAsTim1', 'tandingsAsTim2')
            ->get()
            ->sortByDesc(function ($tim) {
                // Urutkan berdasarkan kemenangan, selisih poin, poin tertinggi, set menang, dan set kalah
                return [
                    $tim->menang,
                    $tim->set_difference,
                    $tim->skor_difference,
                    $tim->skor,
                    $tim->set_menang,
                    $tim->set_kalah
                ];
            });

        // Render view menjadi string HTML khusus untuk PDF
        $htmlContent = view('team.pdf', compact('teams', 'tims'))->render();
        $mpdf->WriteHTML($htmlContent);

        // Output PDF untuk download
        $mpdf->Output('klasemen-tim.pdf', 'D');
    }

    function export_excel()
    {
        return Excel::download(new ExportTeam, "Team.xlsx");
    }
}
