<?php

namespace App\Http\Controllers\Admin\UserManager;

use App\Http\Controllers\Controller;
use App\Models\XWEB_PKCLEAR;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use function redirect;
use function view;

class PkClearController extends Controller
{
    public function index(): View
    {
        $db = ['pkclear' => XWEB_PKCLEAR::get()];
        return view('ap.pkclear', $db);
    }

    public function doPkClear(Request $request): RedirectResponse
    {
        /* Validation */
        $request->validate([
            'zen' => 'required',
        ]);

        /* Update */
        XWEB_PKCLEAR::where('id', $request->id)
            ->update(['zen' => $request->zen
            ]);

        return redirect()->back()->withSuccess('You have changed PK Clear cost settings successfully!');
    }

}
