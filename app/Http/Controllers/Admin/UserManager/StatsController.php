<?php

namespace App\Http\Controllers\Admin\UserManager;

use App\Http\Controllers\Controller;
use App\Models\XWEB_ADDSTATS;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use function redirect;
use function view;

class StatsController extends Controller
{
    public function index(): View
    {
        $db = ['addstats' => XWEB_ADDSTATS::get()];
        return view('ap.addstats', $db);
    }

    public function doAddStats(Request $request): RedirectResponse
    {
        /* Validation */
        $request->validate([
            'maxpoints' => 'required',
        ]);

        /* Update */
        XWEB_ADDSTATS::where('id', $request->id)
            ->update(['maxpoints' => $request->maxpoints

            ]);

        return redirect()->back()->withSuccess('You have changed addstats settings successfully!');
    }
}
