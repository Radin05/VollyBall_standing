<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tim extends Model
{
    protected $fillable = [
        'nama', 'main',
        'menang', 'kalah',
        'set_main',
        'set_menang', 'set_kalah',
        'skor'];

    public function tandingsAsTim1()
    {
        return $this->hasMany(Tanding::class, 'tim1_id');
    }

    public function tandingsAsTim2()
    {
        return $this->hasMany(Tanding::class, 'tim2_id');
    }
    public function getTotalSkorScored()
    {
        $totalSkor = 0;

        // Hitung poin ketika tim menjadi Tim 1
        foreach ($this->tandingsAsTim1 as $tanding) {
            $totalSkor += array_sum($tanding->tim1_set_skor);
        }

        // Hitung poin ketika tim menjadi Tim 2
        foreach ($this->tandingsAsTim2 as $tanding) {
            $totalSkor += array_sum($tanding->tim2_set_skor);
        }

        return $totalSkor;
    }

    // Fungsi untuk menghitung total poin yang kemasukan oleh tim (poin lawan)
    public function getTotalSkorAgainst()
    {
        $totalSkorAgainst = 0;

        // Hitung poin kemasukan ketika tim menjadi Tim 1
        foreach ($this->tandingsAsTim1 as $tanding) {
            $totalSkorAgainst += array_sum($tanding->tim2_set_skor);
        }

        // Hitung poin kemasukan ketika tim menjadi Tim 2
        foreach ($this->tandingsAsTim2 as $tanding) {
            $totalSkorAgainst += array_sum($tanding->tim1_set_skor);
        }

        return $totalSkorAgainst;
    }

    public function getSkorDifferenceAttribute()
    {
        return $this->getTotalSkorScored() - $this->getTotalSkorAgainst();
    }

    // Fungsi untuk menghitung selisih set menang dan set kalah
    public function getSetDifferenceAttribute()
    {
        return $this->set_menang - $this->set_kalah;
    }

}
