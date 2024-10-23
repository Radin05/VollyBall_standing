<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Team;

class TeamsTableSeeder extends Seeder
{
    public function run()
    {
        $teams = [
            ['name' => 'RT 1', 'cover' => 'rt/RT1.png'],
            ['name' => 'RT 2', 'cover' => 'rt/RT2.png'],
            ['name' => 'RT 3', 'cover' => 'rt/RT3.png'],
            ['name' => 'RT 4', 'cover' => 'rt/RT4.png'],
            ['name' => 'RT 5', 'cover' => 'rt/RT5.png'],
            ['name' => 'RT 6', 'cover' => 'rt/RT6.png'],
            ['name' => 'RT 7', 'cover' => 'rt/RT7.png'],
        ];

        foreach ($teams as $team) {
            Team::create($team);
        }
    }
}
