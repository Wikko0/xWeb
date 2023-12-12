<?php

namespace App\Http\Controllers\Admin\UserManager;

use App\Http\Controllers\Controller;
use App\Models\XWEB_CHARACTERS;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use function redirect;
use function view;

class CharacterController extends Controller
{
    public function index(): View
    {
        return view('pages.UserManager.character');
    }

    public function doCharacter(Request $request): RedirectResponse
    {
        foreach ($request->id as $i => $id) {
            $switch = $request->switch[$i] ?? null;

            if ($switch == true) {
                $switch = "Yes";
            } else {
                $switch = "No";
            }

            /* Update */
            XWEB_CHARACTERS::
            where('name', $request->name[$i])
                ->update(
                    [
                        'status' => $switch,
                    ]);
        }

        return redirect()->back()->withSuccess('You have added this updates HOF successfully!');

    }
}
