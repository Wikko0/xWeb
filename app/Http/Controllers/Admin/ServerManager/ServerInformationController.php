<?php

namespace App\Http\Controllers\Admin\ServerManager;

use App\Http\Controllers\Controller;
use App\Models\XWEB_ADMINCP;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use function redirect;
use function view;

class ServerInformationController extends Controller
{
    public function index(): View
    {
        return view('pages.ServerManager.server_information');
    }

    public function doServerInformation(Request $request): RedirectResponse
    {
        /* Validation */
        $request->validate([
            'sname' => 'required',
            'stitle' => 'required',
            'sdescription' => 'required',
            'skeywords' => 'required',
            'surl' => 'required',
            'sforum' => 'required',
            'sdiscord' => 'required',
        ]);

        /* Update */
        XWEB_ADMINCP::where('id', $request->id)->update([
                'sname' => $request->sname,
                'stitle' => $request->stitle,
                'sdescription' => $request->sdescription,
                'skeywords' => $request->skeywords,
                'surl' => $request->surl,
                'sforum' => $request->sforum,
                'sdiscord' => $request->sdiscord
            ]);

        return redirect()->back()->withSuccess('You have changed server information successfully!');
    }
}
