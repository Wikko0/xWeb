<?php

namespace App\Http\Controllers\Admin\WebsiteManager;

use App\Http\Controllers\Controller;
use App\Models\XWEB_DOWNLOAD;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use function redirect;
use function view;

class DownloadController extends Controller
{
    public function index(): View
    {
        return view('pages.WebsiteManager.download');
    }

    public function doDownload(Request $request): RedirectResponse
    {
        /* Validation */
        $request->validate([
            'name' => 'unique:XWEB.XWEB_DOWNLOAD,name',
            'link' => 'active_url',
            'mb' => 'max:15'
        ]);

        /* Insert */
        XWEB_DOWNLOAD::insert([
            'mb' => $request->mb,
            'name' => $request->name,
            'version' => $request->version,
            'link' => $request->link,
            'site' => $request->site
        ]);


        return redirect()->back()->withSuccess('You have added this download link successfully!');
    }

    public function downloadDelete(Request $request): RedirectResponse
    {

        foreach ($request->id as $key => $items) {

            XWEB_DOWNLOAD::where('id', $items)
                ->delete();
        }

        return redirect()->back()->withSuccess('Successfully deleted download link!');
    }
}
