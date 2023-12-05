<?php

namespace Database\Seeders;

use App\Models\XWEB_RESET;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class resetPointsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        XWEB_RESET::create([
            'level' => '350',
            'zen' => '10000000',
            'bkpoints' => '350',
            'smpoints' => '350',
            'elfpoints' => '350',
            'mgpoints' => '350',
            'sumpoints' => '350',
            'rfpoints' => '350',
            'glpoints' => '350',
            'dlpoints' => '350',
            'maxresets' => '40'
        ]);
    }
}
