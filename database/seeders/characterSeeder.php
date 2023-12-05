<?php

namespace Database\Seeders;

use App\Models\XWEB_CHARACTERS;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class characterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $champs = ['Blade Knight','Soul Master','Muse Elf','Magic Gladiator','Dark Lord','Summoner','Rage Fighter','Grow Lancer'];

        foreach ($champs as $champ)
        {
            XWEB_CHARACTERS::create([
                'name' => $champ,
                'class' => $champ,
                'wins' => 1,
                'status' => 'Yes'
            ]);
        }
    }
}
