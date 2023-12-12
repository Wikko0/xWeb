<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Character;
use App\Models\Guild;
use App\Models\MEMB_INFO;
use App\Models\MEMB_STAT;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InformationController extends Controller
{
    public function index(): View
    {
        $countChar = Character::count();
        $countAcc = MEMB_INFO::count();
        $countGuild = Guild::count();
        $countOnline = MEMB_STAT::where('ConnectStat', 1)->count();

        return view('information',[
            'countAcc' => $countAcc,
            'countChar' => $countChar,
            'countGuild' => $countGuild,
            'countOnline' => $countOnline
        ]);

    }
}
