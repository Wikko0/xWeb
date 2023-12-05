<?php

namespace Database\Seeders;

use App\Models\XWEB_ADDSTATS;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class addStatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        XWEB_ADDSTATS::create(['maxpoints' => 32767]);
    }
}
