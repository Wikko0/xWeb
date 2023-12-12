<?php

namespace App\Http\Controllers\Main\User;

use App\Http\Controllers\Controller;
use App\Models\Character;
use App\Models\User;
use App\Models\XWEB_RESET;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use function redirect;
use function view;

class ResetController extends Controller
{
    public function index(): View
    {
        return view('user.reset');
    }

    public function doReset(Request $request): RedirectResponse
    {
        $character = $request->input('char');

        if (empty($character)) {
            return redirect()->back()->withErrors('Choose character first!');
        }

        $onlineStatus = User::getStatus($character);
        $selectedCharacter = Character::findByName($character);
        $resetSettings = XWEB_RESET::first();


        $points = match (intval($selectedCharacter->Class)) {
            0, 1, 2, 3, 7 => $resetSettings->smpoints,
            16, 17, 18, 19, 23 => $resetSettings->bkpoints,
            32, 33, 34, 35, 39 => $resetSettings->mepoints,
            48, 49, 50, 54 => $resetSettings->mgpoints,
            64, 65, 66, 70 => $resetSettings->dlpoints,
            80, 81, 83, 87 => $resetSettings->sumpoints,
            96, 98, 10 => $resetSettings->rfpoints,
            112, 114, 118 => $resetSettings->glpoints,
            default => null,
        };

        if ($points === null) {
            return redirect()->back()->withErrors('Invalid character class!');
        }

        $newZen = $selectedCharacter->Money - $resetSettings->zen;
        $newPoints = ($selectedCharacter->Resets +1 ) * $points;


        if ($selectedCharacter->cLevel < $resetSettings->level) {
            return redirect()->back()->withErrors("You're not Max Level!");
        } elseif ($newZen < 0) {
            return redirect()->back()->withErrors("You don't have enough zen!");
        } elseif ($selectedCharacter->Resets >= $resetSettings->maxresets) {
            return redirect()->back()->withErrors("You're Max Resets!");
        } elseif ($onlineStatus === 'Online') {
            return redirect()->back()->withErrors("Leave game first!");
        } else {
            Character::where('Name', $character)
                ->update([
                    'Resets' => DB::raw('Resets+1'),
                    'Strength' => 25,
                    'Dexterity' => 25,
                    'Vitality' => 25,
                    'Energy' => 25,
                    'Experience' => 0,
                    'LevelUpPoint' => $newPoints,
                    'Money' => $newZen,
                    'cLevel' => 1
                ]);
        }

        return redirect()->back()->withSuccess('You have reset this character successfully!');
    }
}
