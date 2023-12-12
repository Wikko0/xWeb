<?php

namespace App\Http\Controllers\Main\User;

use App\Http\Controllers\Controller;
use App\Models\Character;
use App\Models\User;
use App\Models\XWEB_CHAR_INFO;
use App\Models\XWEB_CREDITS;
use App\Models\XWEB_GRANDRESET;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use function redirect;
use function view;

class GrandResetController extends Controller
{
    public function index(): View
    {
        return view('user.grandreset');
    }

    public function doGrandReset(Request $request): RedirectResponse
    {
        $character = $request->input('char');

        if (empty($character)) {
            return redirect()->back()->withErrors('Choose character first!');
        }

        $online = User::getStatus($character);
        $selectedCharacter = Character::findByName($character);
        $credits = XWEB_CREDITS::findByAccount($selectedCharacter->AccountID);
        $gReset = XWEB_GRANDRESET::first();
        $charInfo = XWEB_CHAR_INFO::findByName($character);

        $newZen = $selectedCharacter->Money - $gReset->zen;
        $newCredits = $gReset->credits + $credits->credits;

        // Verification
        if ($selectedCharacter->cLevel < $gReset->level) {
            return redirect()->back()->withErrors('You\'re not Max Level!');
        } elseif ($newZen < 0) {
            return redirect()->back()->withErrors('You don\'t have enough zen!');
        } elseif ($selectedCharacter->Resets < $gReset->resets) {
            return redirect()->back()->withErrors('You\'re Not Max Resets!');
        } elseif ($charInfo->gresets + 1 > $gReset->maxgresets) {
            return redirect()->back()->withErrors('You\'re Max Grand-Resets!');
        } elseif ($online == 'Online') {
            return redirect()->back()->withErrors('Leave game first!');
        } else {

            Character::where('Name', $character)
                ->update([
                    'Resets' => 0,
                    'Strength' => 25,
                    'Dexterity' => 25,
                    'Vitality' => 25,
                    'Energy' => 25,
                    'Experience' => 0,
                    'LevelUpPoint' => 0,
                    'Money' => $newZen,
                    'cLevel' => 1
                ]);

            $credits->update(['credits' => $newCredits]);

            if (empty($charInfo->name)) {
                $charInfo->insert([
                    'name' => $character,
                    'gresets' => 1
                ]);
            } else {
                $charInfo
                    ->update(['gresets' => DB::raw('gresets+1')]);
            }
        }

        return redirect()->back()->withSuccess('You have reset this character successfully!');
    }
}
