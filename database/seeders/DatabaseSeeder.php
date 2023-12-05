<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(addStatsSeeder::class);
        $this->call(adminLoginSeeder::class);
        $this->call(characterSeeder::class);
        $this->call(grandResetSeeder::class);
        $this->call(informationSeeder::class);
        $this->call(paypalSeeder::class);
        $this->call(pkClearSeeder::class);
        $this->call(reNameSeeder::class);
        $this->call(resetPointsSeeder::class);
        $this->call(resetStatsSeeder::class);
        $this->call(serverInformationSeeder::class);
    }
}
