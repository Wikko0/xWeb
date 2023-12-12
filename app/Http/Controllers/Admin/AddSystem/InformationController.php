<?php

namespace App\Http\Controllers\Admin\AddSystem;

use App\Http\Controllers\Controller;
use App\Models\XWEB_ADD_INFORMATION;
use App\Models\XWEB_INFORMATION;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use function redirect;
use function view;

class InformationController extends Controller
{
    public function index(): View
    {

        return view('pages.AddSystem.information');
    }

    public function doInformation(Request $request): RedirectResponse
    {
        /* Validation */
        $request->validate([
            'sname' => 'required',
            'version' => 'required',
            'exp' => 'required',
            'drop' => 'required',
            'zen' => 'required',
            'ppl' => 'required',
        ]);

        /* Update */
        XWEB_INFORMATION::where('id', $request->id)
            ->update([
                'sname' => $request->sname,
                'version' => $request->version,
                'experience' => $request->exp,
                'droprate' => $request->drop,
                'zenrate' => $request->zen,
                'ppl' => $request->ppl
            ]);

        return redirect()->back()->withSuccess('You have changed Information successfully!');
    }

    public function addInfo(): View
    {
        return view('pages.AddSystem.addinfo');
    }

    public function doAddInfo(Request $request): RedirectResponse
    {
        /* Validation */
        $request->validate([
            'information' => 'required',
        ]);

        /* Update */
        XWEB_ADD_INFORMATION::
        updateOrCreate(
            ['row' => 1],
            ['information' => $request->information]);

        return redirect()->back()->withSuccess('You have added this information successfully!');
    }
}
