<?php

namespace App\Http\Controllers\Admin\UserManager;

use App\Http\Controllers\Controller;
use App\Models\XWEB_RENAME;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use function redirect;
use function view;

class RenameController extends Controller
{
    public function index(): View
    {

        return view('pages.UserManager.rename');
    }

    public function doReName(Request $request): RedirectResponse
    {
        /* Validation */
        $request->validate([
            'credits' => 'required',
        ]);

        /* Update */
        XWEB_RENAME::where('id', $request->id)
            ->update(['credits' => $request->credits
            ]);

        return redirect()->back()->withSuccess('You have changed RENAME cost settings successfully!');
    }
}
