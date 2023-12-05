<?php

namespace Database\Seeders;

use App\Models\XWEB_GRANDRESET;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class grandResetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        XWEB_GRANDRESET::create([
            'resets' => '40',
            'maxgresets' => '1',
            'level' => '350',
            'zen' => '100000',
            'credits' => '200'
        ]);
    }
}
