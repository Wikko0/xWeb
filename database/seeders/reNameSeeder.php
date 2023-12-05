<?php

namespace Database\Seeders;

use App\Models\XWEB_RENAME;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class reNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        XWEB_RENAME::create([
            'credits' => 200
        ]);
    }
}
