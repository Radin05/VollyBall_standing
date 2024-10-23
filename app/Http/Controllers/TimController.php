<?php

namespace App\Http\Controllers;

use App\Models\Tim;
use Mpdf\Mpdf;
use Illuminate\Http\Request;

class TimController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua tim beserta data pertandingan yang relevan
        $tims = Tim::with('tandingsAsTim1', 'tandingsAsTim2')
                    ->get()
                    ->sortByDesc(function ($tim) {
                         // Urutkan berdasarkan kemenangan, selisih poin, poin tertinggi, set menang, dan set kalah
                        return [
                             $tim->menang, // Urutkan berdasarkan jumlah kemenangan
                             $tim->set_difference, // Lalu urutkan berdasarkan selisih set
                             $tim->skor_difference, // Lalu urutkan berdasarkan selisih poin
                             $tim->skor, // Urutkan berdasarkan poin tertinggi
                             $tim->set_menang, // Jika poin sama, urutkan berdasarkan set menang
                             $tim->set_kalah // Urutkan berdasarkan sedikit set kalah (gunakan minus agar urutan asc)
                        ];
                    });

        // Kembalikan view dengan data tim yang diurutkan
        return view('tim.index', compact('tims'));
    }
}
