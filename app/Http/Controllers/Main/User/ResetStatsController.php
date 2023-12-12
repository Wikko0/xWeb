<?php

namespace App\Http\Controllers\Main\User;

use App\Http\Controllers\Controller;
use App\Models\Character;
use App\Models\User;
use App\Models\XWEB_CREDITS;
use App\Models\XWEB_RESETSTATS;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use function redirect;
use function view;

class ResetStatsController extends Controller
{
    public function index(): View
    {
        return view('user.resetstats');
    }

    public function doResetStats(Request $request): RedirectResponse
    {
        $character = $request->input('char');

        if (empty($request->char)) {
            return redirect()->back()->withErrors('Choose character first!');
        }

        $online = User::getStatus($character);
        $selectedCharacter = Character::findByName($character);
        $fee = XWEB_RESETSTATS::first();
        $credits = XWEB_CREDITS::findByAccount($selectedCharacter->AccountID);
        $newCredits = $credits->credits - $fee->credits;
        $newZen = $selectedCharacter->Money - $fee->zen;
        $newPoints = ($selectedCharacter->Strength + $selectedCharacter->Dexterity + $selectedCharacter->Vitality + $selectedCharacter->Energy) - 100;
        $newStats = $selectedCharacter->LevelUpPoint + $newPoints;

        // Verification
        if ($newCredits < 0) {
            return redirect()->back()->withErrors('You don\'t have enough credits!');
        } elseif ($selectedCharacter->cLevel < $fee->level) {
            return redirect()->back()->withErrors('You don\'t have enough levels!');
        } elseif ($selectedCharacter->Resets < $fee->resets) {
            return redirect()->back()->withErrors('You don\'t have enough resets!');
        } elseif ($newZen < 0) {
            return redirect()->back()->withErrors('You don\'t have enough zen!');
        } elseif ($online == 'Online') {
            return redirect()->back()->withErrors('Leave game first!');
        }
        // Update
        else {
            Character::
            where('Name', '=', $character)
                ->update([
                    'Strength' => 25,
                    'Dexterity' => 25,
                    'Vitality' => 25,
                    'Energy' => 25,
                    'LevelUpPoint' => $newStats,
                    'Money' => $newZen
                ]);
            $credits
                ->update([
                    'credits' => $newCredits
                ]);
        }

        return redirect()->back()->withSuccess('You have reset stats successfully!');
    }
}
