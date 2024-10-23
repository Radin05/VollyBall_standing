<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tanding extends Model
{
    protected $fillable = [
        'tim1_id', 'tim2_id',
        'tim1_skor', 'tim2_skor',
        'tim1_set_menang', 'tim2_set_menang',
        'tim1_set_skor', 'tim2_set_skor',
    ];

    protected $casts = [
        'tim1_set_skor' => 'array',
        'tim2_set_skor' => 'array',
    ];
    public function tim1()
    {
        return $this->belongsTo(Tim::class, 'tim1_id');
    }

    public function tim2()
    {
        return $this->belongsTo(Tim::class, 'tim2_id');
    }

    // Fungsi untuk menghitung total skor tim 1
    public function getTotalskorTim1()
    {
        return array_sum($this->tim1_set_skor);
    }

    // Fungsi untuk menghitung total skor tim 2
    public function getTotalskorTim2()
    {
        return array_sum($this->tim2_set_skor);
    }

    public function updateStandings()
    {
        $tim1 = $this->tim1;
        $tim2 = $this->tim2;

        // Tambahkan jumlah pertandingan yang dimainkan
        $tim1->main += 1;
        $tim2->main += 1;

        $tim1->set_main += $this->tim1_set_menang + $this->tim2_set_menang; // Total set yang dimainkan oleh tim1
        $tim2->set_main += $this->tim1_set_menang + $this->tim2_set_menang; // Total set yang dimainkan oleh team2

        // Cek siapa yang menang
        if ($this->tim1_skor > $this->tim2_skor) {
            $tim1->menang += 1;
            $tim2->kalah += 1;
            $tim1->skor += 1; // Misalnya 3 poin untuk kemenangan
        } elseif ($this->tim1_skor < $this->tim2_skor) {
            $tim2->menang += 1;
            $tim1->kalah += 1;
            $tim2->skor += 1;
        }

        // Tambahkan jumlah set yang dimenangkan dan kalah
        $tim1->set_menang += $this->tim1_set_menang;
        $tim1->set_kalah += $this->tim2_set_menang;

        $tim2->set_menang += $this->tim2_set_menang;
        $tim2->set_kalah += $this->tim1_set_menang;

        // Simpan perubahan
        $tim1->save();
        $tim2->save();
    }

    public function rollbackTimStats($tim)
    {
        // Pastikan $tim tidak null
        if (!$tim) {
            throw new \Exception('Tim tidak ditemukan dalam database.');
        }

        // Rollback hanya statistik dari pertandingan ini
        if ($this->tim1_id == $tim->id) {
            // Kurangi jumlah pertandingan yang dimainkan
            $tim->main -= 1;

            // Rollback jumlah set yang dimainkan
            $tim->set_main -= $this->tim1_set_menang + $this->tim2_set_menang;

            // Rollback statistik kemenangan/kekalahan dan poin
            if ($this->tim1_skor > $this->tim2_skor) {
                $tim->menang -= 1;
                $tim->skor -= 3; // Misalnya 3 poin untuk kemenangan
            } else {
                $tim->kalah -= 1;
            }

            // Rollback jumlah set yang dimenangkan dan kalah
            $tim->set_menang -= $this->tim1_set_menang;
            $tim->set_kalah -= $this->tim2_set_menang;

        } elseif ($this->tim2_id == $tim->id) {
            // Kurangi jumlah pertandingan yang dimainkan
            $tim->main -= 1;

            // Rollback jumlah set yang dimainkan
            $tim->set_main -= $this->tim1_set_menang + $this->tim2_set_menang;

            // Rollback statistik kemenangan/kekalahan dan poin
            if ($this->tim2_skor > $this->tim1_skor) {
                $tim->menang -= 1;
                $tim->skor -= 3;
            } else {
                $tim->kalah -= 1;
            }

            // Rollback jumlah set yang dimenangkan dan kalah
            $tim->set_menang -= $this->tim2_set_menang;
            $tim->set_kalah -= $this->tim1_set_menang;
        }

        // Simpan perubahan hanya setelah rollback berhasil
        $tim->save();
    }

}
