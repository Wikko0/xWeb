<?php

namespace App\Http\Controllers\Admin\UserManager;

use App\Http\Controllers\Controller;
use App\Models\XWEB_RESET;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use function redirect;
use function view;

class ResetController extends Controller
{
    public function index(): View
    {
        $db = ['reset' => XWEB_RESET::get()];
        return view('ap.reset', $db);
    }

    public function doReset(Request $request): RedirectResponse
    {
        /* Validation */
        $request->validate([
            'maxresets' => 'required',
            'level' => 'required',
            'zen' => 'required',
            'bkpoints' => 'required',
            'smpoints' => 'required',
            'elfpoints' => 'required',
            'mgpoints' => 'required',
            'dlpoints' => 'required',
            'sumpoints' => 'required',
            'rfpoints' => 'required',
            'glpoints' => 'required',
        ]);

        XWEB_RESET::
        where('id', $request->id)
            ->update(['maxresets' => $request->maxresets,
                'level' => $request->level,
                'zen' => $request->zen,
                'bkpoints' => $request->bkpoints,
                'smpoints' => $request->smpoints,
                'elfpoints' => $request->elfpoints,
                'mgpoints' => $request->mgpoints,
                'dlpoints' => $request->dlpoints,
                'sumpoints' => $request->sumpoints,
                'rfpoints' => $request->rfpoints,
                'glpoints' => $request->glpoints,

            ]);

        return redirect()->back()->withSuccess('You have changed reset settings successfully!');
    }

}
