<?php

namespace App\Http\Controllers\Admin\AddSystem;

use App\Http\Controllers\Controller;
use App\Models\XWEB_CHARACTERS;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use function redirect;
use function view;

class HofController extends Controller
{
    public function index(): View
    {
        $char = XWEB_CHARACTERS::get();
        return view('pages.AddSystem.hof', ['char' => $char]);
    }

    public function hofAdd(Request $request): RedirectResponse
    {
        /* Validation */
        $request->validate([
            'name' => 'required',
            'wins' => 'required',
            'class' => 'required',
        ]);

        /* Update */
        XWEB_CHARACTERS::
        where('class', '=', $request->class)
            ->update([
                'name' => $request->name,
                'wins' => $request->wins
            ]);
        return redirect()->back()->withSuccess('You have added this updates HOF successfully!');
    }
}
