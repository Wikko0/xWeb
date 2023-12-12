<?php

namespace App\Http\Controllers\Main\User;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use function view;

class BuyController extends Controller
{
    public function buyCredits(): View
    {
        return view('user.buycredits');
    }

    public function buyVip(): View
    {
        return view('user.buyvip');
    }
}
