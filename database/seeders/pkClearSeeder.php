<?php

namespace Database\Seeders;

use App\Models\XWEB_PKCLEAR;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class pkClearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        XWEB_PKCLEAR::create([
            'zen' => 10000000
        ]);
    }
}
