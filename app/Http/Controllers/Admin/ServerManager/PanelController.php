<?php

namespace App\Http\Controllers\Admin\ServerManager;

use App\Http\Controllers\Controller;
use App\Models\XWEB_ADMINLOGIN;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use function redirect;
use function view;

class PanelController extends Controller
{
    public function index(): View
    {
        return view('pages.ServerManager.panel');
    }

    public function doPanel(Request $request): RedirectResponse
    {
        /* Validation */
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        /* Update */
        XWEB_ADMINLOGIN::where('id', $request->id)->update([
            'admin' => $request->name,
            'password' => $request->password
        ]);

        return redirect()->back()->withSuccess('You have changed admin user successfully!');
    }
}
