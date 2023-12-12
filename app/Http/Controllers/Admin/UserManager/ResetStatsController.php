<?php

namespace App\Http\Controllers\Admin\UserManager;

use App\Http\Controllers\Controller;
use App\Models\XWEB_RESETSTATS;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use function redirect;
use function view;

class ResetStatsController extends Controller
{
    public function index(): View
    {
        return view('pages.UserManager.resetstats');
    }

    public function doResetStats(Request $request): RedirectResponse
    {
        /* Validation */
        $request->validate([
            'credits' => 'required',
            'zen' => 'required',
            'level' => 'required',
            'resets' => 'required',
        ]);

        /* Update */
        XWEB_RESETSTATS::where('id', $request->id)
            ->update([
                'credits' => $request->credits,
                'zen' => $request->zen,
                'level' => $request->level,
                'resets' => $request->resets,
            ]);

        return redirect()->back()->withSuccess('You have changed ResetStats cost settings successfully!');
    }
}
