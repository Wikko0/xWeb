<?php

namespace App\Http\Controllers\Admin\WebsiteManager;

use App\Http\Controllers\Controller;
use App\Models\XWEB_ANNOUNCE;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use function redirect;
use function view;

class AnnounceController extends Controller
{
    public function index(): View
    {
        $select = XWEB_ANNOUNCE::first();
        return view('ap.announce', ['announce_config' => $select]);
    }

    public function doAnnounce(Request $request): RedirectResponse
    {
        /* Validation */
        $request->validate([
            'date' => 'required',
            'title' => 'required',
        ]);

        /* Update */
        XWEB_ANNOUNCE::updateOrCreate(
            ['row' => 1],
            ['status' => $request->status, 'date' => $request->date, 'title' => $request->title]);

        return redirect()->back()->withSuccess('You have added announce successfully!');
    }
}
