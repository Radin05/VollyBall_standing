<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tim;

class TimSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tims = [
            ['nama' => 'RT 1', 'logo' => 'rt/RT1.png'],
            ['nama' => 'RT 2', 'logo' => 'rt/RT2.png'],
            ['nama' => 'RT 3', 'logo' => 'rt/RT3.png'],
            ['nama' => 'RT 4', 'logo' => 'rt/RT4.png'],
            ['nama' => 'RT 5', 'logo' => 'rt/RT5.png'],
            ['nama' => 'RT 6', 'logo' => 'rt/RT6.png'],
            ['nama' => 'RT 7', 'logo' => 'rt/RT7.png'],
        ];

        foreach ($tims as $tim) {
            Tim::create($tim);
        }
    }
}
