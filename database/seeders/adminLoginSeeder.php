<?php

namespace Database\Seeders;

use App\Models\XWEB_ADMINLOGIN;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class adminLoginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        XWEB_ADMINLOGIN::create([
            'admin' => 'admin',
            'password' => 'admin'
        ]);
    }
}
