<?php

namespace App\Http\Controllers\Admin\UserManager;

use App\Http\Controllers\Controller;
use App\Models\XWEB_VIP_PACKAGE;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use function redirect;
use function view;

class VipController extends Controller
{
    public function index(): View
    {
        $db = ['vip_pack' => XWEB_VIP_PACKAGE::get()];
        return view('ap.vip_pack', $db);
    }

    public function doVipPack(Request $request): RedirectResponse
    {
        /* Validation */
        $request->validate([
            'name' => 'required',
            'days' => 'required',
            'credits' => 'required',
        ]);

        /* Update */
        XWEB_VIP_PACKAGE::insert([
            'name' => $request->name,
            'days' => $request->days,
            'credits' => $request->credits
        ]);


        return redirect()->back()->withSuccess('You have added this package successfully!');
    }

    public function vipPackDelete(Request $request): RedirectResponse
    {

        foreach ($request->id as $items) {

            XWEB_VIP_PACKAGE::where('id', $items)
                ->delete();
        }

        return redirect()->back()->withSuccess('Successfully deleted package!');
    }
}
