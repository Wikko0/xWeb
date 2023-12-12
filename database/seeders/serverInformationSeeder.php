<?php

namespace Database\Seeders;

use App\Models\XWEB_ADMINCP;
use App\Models\XWEB_WEB_INFORMATION;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class serverInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        XWEB_WEB_INFORMATION::create([
            'sname' => 'XWeb Server',
            'stitle' => 'XWeb',
            'sdescription' => 'MU Online',
            'skeywords' => 'MU Online',
            'surl' => 'https://127.0.0.1',
            'sforum' => 'https://127.0.0.1',
            'sdiscord' => 'https://discord.com',
        ]);
    }
}
