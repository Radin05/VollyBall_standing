<?php

namespace App\Http\Controllers;

use App\Models\Tanding;
use App\Models\Tim;
use Illuminate\Http\Request;

class TandingController extends Controller
{

    public function index()
    {
        // Ambil semua pertandingan dari database
        $tandings = Tanding::with(['tim1', 'tim2'])->get();

        // Kirim data pertandingan ke view
        return view('tanding.index', compact('tandings'));
    }

    public function create()
    {
        // Ambil semua tim untuk ditampilkan di dropdown
        $tims = Tim::all();
        $tandings = Tanding::all();

        // Tampilkan view dengan data tim
        return view('tanding.create', compact('tims', 'tandings'));
    }

    public function store(Request $request)
    {
        // Validasi input
        // $request->validate([
        //     'tim1_id' => 'required|exists:tims,id',
        //     'tim2_id' => 'required|exists:tims,id',
        //     'tim1_set_menang' => 'required|integer',
        //     'tim2_set_menang' => 'required|integer',
        //     'tim1_set_skor' => 'required|array',
        //     'tim2_set_skor' => 'required|array',
        //     'tim1_set_skor.*' => 'integer',
        //     'tim2_set_skor.*' => 'integer',
        // ]);

        $tanding = Tanding::create([
            'tim1_id' => $request->tim1_id,
            'tim2_id' => $request->tim2_id,
            'tim1_skor' => $request->tim1_skor,
            'tim2_skor' => $request->tim2_skor,
            'tim1_set_menang' => $request->tim1_set_menang,
            'tim2_set_menang' => $request->tim2_set_menang,
            'tim1_set_skor' => $request->tim1_set_skor,
            'tim2_set_skor' => $request->tim2_set_skor,
        ]);

        // Perbarui klasemen
        $tanding->updateStandings();

        return redirect()->route('tim.index')->with('success', 'Pertandingan telah disimpan dan klasemen diperbarui.');
    }

    public function edit($id)
    {
        // Ambil data pertandingan berdasarkan ID
        $tanding = Tanding::findOrFail($id);

        // Ambil data semua tim untuk dropdown
        $tims = Tim::all();

        return view('tanding.edit', compact('tanding', 'tims'));
    }

    public function update(Request $request, $id)
    {
        // Temukan pertandingan yang akan diupdate
        $tanding = Tanding::findOrFail($id);

        // Dapatkan data tim terkait
        $tim1 = $tanding->tim1;
        $tim2 = $tanding->tim2;

        // Simpan ID tim lama
        $oldTim1Id = $tim1->id;
        $oldTim2Id = $tim2->id;

        // Rollback statistik tim lama
        $this->rollbackTimStats($tim1, $tanding);
        $this->rollbackTimStats($tim2, $tanding);

        // Update data pertandingan
        $tanding->update([
            'tim1_id' => $request->tim1_id,
            'tim2_id' => $request->tim2_id,
            'tim1_skor' => $request->tim1_skor,
            'tim2_skor' => $request->tim2_skor,
            'tim1_set_menang' => $request->tim1_set_menang,
            'tim2_set_menang' => $request->tim2_set_menang,
            'tim1_set_skor' => $request->tim1_set_skor,
            'tim2_set_skor' => $request->tim2_set_skor,
        ]);

        // Ambil tim baru setelah update
        $newTim1 = Tim::findOrFail($request->tim1_id);
        $newTim2 = Tim::findOrFail($request->tim2_id);

        // Update statistik tim baru
        $this->updateTimStats($newTim1, $newTim2, $request);

        return redirect()->route('tim.index')->with('success', 'Pertandingan berhasil diperbarui.');
    }

    private function rollbackTimStats($tim, $tanding)
    {
        if ($tim) {
            // Kurangi jumlah pertandingan yang dimainkan
            $tim->main -= 1;

            // Kurangi jumlah kemenangan/kekalahan lama
            if ($tanding->tim1_set_menang > $tanding->tim2_set_menang && $tim->id == $tanding->tim1_id) {
                $tim->menang -= 1;
            } elseif ($tanding->tim2_set_menang > $tanding->tim1_set_menang && $tim->id == $tanding->tim2_id) {
                $tim->menang -= 1;
            } else {
                $tim->kalah -= 1;
            }

            // Kurangi jumlah set yang lama
            $tim->set_menang -= ($tim->id == $tanding->tim1_id) ? $tanding->tim1_set_menang : $tanding->tim2_set_menang;
            $tim->set_kalah -= ($tim->id == $tanding->tim1_id) ? $tanding->tim2_set_menang : $tanding->tim1_set_menang;

            // Kurangi skor lama
            $tim_total_skor = ($tim->id == $tanding->tim1_id) ? array_sum($tanding->tim1_set_skor) : array_sum($tanding->tim2_set_skor);
            $tim->skor = max(0, $tim->skor - $tim_total_skor);

            // Simpan perubahan tim
            $tim->save();
        }
    }

    private function updateTimStats($newTim1, $newTim2, $request)
    {
        // Tambahkan jumlah pertandingan yang dimainkan untuk tim baru
        $newTim1->main += 1;
        $newTim2->main += 1;

        // Cek siapa yang menang
        if ($request->tim1_set_menang > $request->tim2_set_menang) {
            $newTim1->menang += 1;
            $newTim2->kalah += 1;
        } elseif ($request->tim2_set_menang > $request->tim1_set_menang) {
            $newTim2->menang += 1;
            $newTim1->kalah += 1;
        }

        // Tambahkan jumlah set yang dimenangkan dan kalah
        $newTim1->set_menang += $request->tim1_set_menang;
        $newTim1->set_kalah += $request->tim2_set_menang;

        $newTim2->set_menang += $request->tim2_set_menang;
        $newTim2->set_kalah += $request->tim1_set_menang;

        // Update skor
        $newTim1->skor += array_sum($request->tim1_set_skor);
        $newTim2->skor += array_sum($request->tim2_set_skor);

        // Simpan perubahan pada kedua tim
        $newTim1->save();
        $newTim2->save();
    }

    public function destroy($id)
    {
        // Temukan pertandingan berdasarkan ID
        $tanding = Tanding::findOrFail($id);

        // Dapatkan tim yang terlibat dalam pertandingan
        $tim1 = $tanding->tim1; // Tim 1
        $tim2 = $tanding->tim2; // Tim 2

        // Kurangi statistik untuk Tim 1 dan Tim 2

        // 1. Update jumlah pertandingan yang dimainkan
        $tim1->main -= 1;
        $tim2->main -= 1;

        // 2. Periksa siapa yang memenangkan pertandingan, dan perbarui statistik menang/kalah
        if ($tanding->tim1_set_menang > $tanding->tim2_set_menang) {
            // Jika Tim 1 menang
            $tim1->menang -= 1; // Kurangi jumlah kemenangan Tim 1
            $tim2->kalah -= 1; // Kurangi jumlah kekalahan Tim 2
        } elseif ($tanding->tim2_set_menang > $tanding->tim1_set_menang) {
            // Jika Tim 2 menang
            $tim2->menang -= 1; // Kurangi jumlah kemenangan Tim 2
            $tim1->kalah -= 1; // Kurangi jumlah kekalahan Tim 1
        }

        // 3. Update jumlah set menang dan set kalah
        $tim1->set_menang -= $tanding->tim1_set_menang;
        $tim1->set_kalah -= $tanding->tim2_set_menang;

        $tim2->set_menang -= $tanding->tim2_set_menang;
        $tim2->set_kalah -= $tanding->tim1_set_menang;

        // 4. Update poin (kurangi poin, pastikan poin tidak negatif)
        $tim1_total_skor = array_sum($tanding->tim1_set_skor); // Total poin yang dicetak oleh Tim 1
        $tim2_total_skor = array_sum($tanding->tim2_set_skor); // Total poin yang dicetak oleh Tim 2

        // Pastikan poin tidak menjadi negatif
        $tim1->skor = max(0, $tim1->skor - $tim1_total_skor);
        $tim2->skor = max(0, $tim2->skor - $tim2_total_skor);

        // 5. Simpan perubahan pada kedua tim
        $tim1->save();
        $tim2->save();

        // 6. Hapus pertandingan
        $tanding->delete();

        // Redirect ke halaman tanding.index dengan pesan sukses
        return redirect()->route('tim.index')
            ->with('success', 'Pertandingan dan statistik tim berhasil diperbarui dan dihapus.');
    }

}
