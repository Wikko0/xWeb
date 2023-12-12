<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Character;
use App\Models\MEMB_INFO;
use App\Models\MEMB_STAT;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {

        $accInfo = MEMB_INFO::count();
        $charInfo = Character::count();
        $online = MEMB_STAT::where('ConnectStat', 1)->count();
        $today = MEMB_STAT::where([
            ['ConnectStat', 1],
            ['ConnectTM', '>', Carbon::now()->subDays(1)],
        ])->count();

        return view('pages.home', [
            'accInfo' => $accInfo,
            'charInfo' => $charInfo,
            'online' => $online,
            'today' => $today
        ]);

    }
}
