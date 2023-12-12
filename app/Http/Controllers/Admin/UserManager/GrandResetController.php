<?php

namespace App\Http\Controllers\Admin\UserManager;

use App\Http\Controllers\Controller;
use App\Models\XWEB_GRANDRESET;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use function redirect;
use function view;

class GrandResetController extends Controller
{
    public function index(): View
    {
        return view('pages.UserManager.grandreset');
    }

    public function doGrandReset(Request $request): RedirectResponse
    {
        /* Validation */
        $request->validate([
            'maxgresets' => 'required',
            'resets' => 'required',
            'level' => 'required',
            'zen' => 'required',
            'credits' => 'required',
        ]);

        /* Update */
        XWEB_GRANDRESET::where('id', $request->id)
            ->update(['maxgresets' => $request->maxgresets,
                'resets' => $request->resets,
                'level' => $request->level,
                'zen' => $request->zen,
                'credits' => $request->credits,

            ]);

        return redirect()->back()->withSuccess('You have changed reset settings successfully!');
    }
}
