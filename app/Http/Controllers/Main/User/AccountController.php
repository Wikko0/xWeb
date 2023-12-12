<?php

namespace App\Http\Controllers\Main\User;

use App\Http\Controllers\Controller;
use App\Models\Character;
use App\Models\MEMB_INFO;
use App\Models\Units;
use App\Models\XWEB_ADMINLOGIN;
use App\Models\XWEB_CREDITS;
use App\Models\XWEB_VIP;
use Illuminate\View\View;
use function route;
use function session;
use function view;

class AccountController extends Controller
{

    public function index(): View
    {
        $userInfo = MEMB_INFO::where('memb___id', '=', session('User'))->first();
        $select = Character::where('AccountID', '=', session('User'))->get();
        $adminCheck = XWEB_ADMINLOGIN::first();
        $vipCheck = XWEB_VIP::where('account', session('User'))->first();
        $credits = XWEB_CREDITS::where('name', session('User'))->first();

        // Output
        $output = "";
        foreach ($select as $index => $character) {
            $row = Units::generateCharacterPanel($index, $character);
            $output .= $row;

        }

        // Rank
        $rank = ($adminCheck->admin == session('User')) ? 'Administrator' : 'User';

        // Vip
        $expires = $vipCheck->expires ?? 'Expired';
        $account = $vipCheck->account ?? 0;
        $vip = ($expires != 'Expired' && $account == session('User')) ? 'Activated' : 'None (<a href="' . route('buyvip') . '">Buy Now</a>)';

        return view('user.account-panel',
            [
                'userInfo' => $userInfo,
                'output' => $output,
                'rank' => $rank,
                'vip' => $vip,
                'vipCheck' => $vipCheck,
                'credits' => $credits
            ]);
    }

}
