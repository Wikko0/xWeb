<?php

namespace App\Http\Controllers\Main\User;

use App\Http\Controllers\Controller;
use App\Models\Character;
use App\Models\Units;
use App\Models\User;
use App\Models\XWEB_PKCLEAR;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use function redirect;
use function view;

class ClearPkController extends Controller
{
    public function index(): View
    {
        return view('user.clearpk', [
            'pk' => new Units()
        ]);
    }

    public function doClearPk(Request $request): RedirectResponse
    {
        $character = $request->input('char');

        if (empty($character)) {
            return redirect()->back()->withErrors('Choose character first!');
        }

        $online = User::getStatus($character);
        $selectedCharacter = Character::findByName($character);
        $zen = XWEB_PKCLEAR::first();

        $cost = $selectedCharacter->PkCount * $zen->zen;
        $newZen = $selectedCharacter->Money - $cost;


        // Verification
        if ($newZen < 0) {
            return redirect()->back()->withErrors('You don\'t have enough zen!');
        } elseif ($selectedCharacter->PkCount == 0) {
            return redirect()->back()->withErrors('You don\'t have kills yet!');
        } elseif ($online == 'Online') {
            return redirect()->back()->withErrors('Leave game first!');
        } // Update
        else {

            Character::where('Name', $character)
                ->update([
                    'Money' => $newZen,
                    'PkLevel' => 0,
                    'PkCount' => 0
                ]);

        }

        return redirect()->back()->withSuccess('You have reset this character successfully!');
    }
}
