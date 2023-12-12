<?php

namespace App\Http\Controllers\Main\User;

use App\Http\Controllers\Controller;
use App\Models\Character;
use App\Models\User;
use App\Models\XWEB_ADDSTATS;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use function redirect;
use function view;

class AddStatsController extends Controller
{
    public function index(): View
    {
        return view('user.add-stats');
    }

    public function doAddStats(Request $request): RedirectResponse
    {

        $character = $request->input('char');

        if (empty($character)) {
            return redirect()->back()->withErrors('Choose character first!');
        } else {
            $selectedCharacter = Character::findByName($character);
            $addStats = XWEB_ADDSTATS::first();
            $newPoints = $selectedCharacter->LevelUpPoint - ($request->str + $request->agi + $request->vit + $request->ene);
            $maxPoints = $addStats->maxpoints;

            // 4Check
            $dl = 0;
            $newStr = $selectedCharacter->Strength + $request->str;
            $newAgi = $selectedCharacter->Dexterity + $request->agi;
            $newVit = $selectedCharacter->Vitality + $request->vit;
            $newEne = $selectedCharacter->Energy + $request->ene;
            $newCom = $selectedCharacter->Leadership + $request->com;
            $online = User::getStatus($character);

            $dataToUpdate = [
                'Strength' => $selectedCharacter->Strength + $request->str,
                'Dexterity' => $selectedCharacter->Dexterity + $request->agi,
                'Vitality' => $selectedCharacter->Vitality + $request->vit,
                'Energy' => $selectedCharacter->Energy + $request->ene,
                'LevelUpPoint' => $newPoints,
            ];

            if (in_array($selectedCharacter->Class, [64, 65, 66])) {
                $dataToUpdate['Leadership'] = $newCom;
                $dl = 1;
            }

            // Verification
            if ($newPoints < 0) {
                return redirect()->back()->withErrors('You don\'t have enough points!');
            } elseif ($newStr > $maxPoints or $newAgi > $maxPoints or $newVit > $maxPoints or $newEne > $maxPoints or $newCom > $maxPoints) {
                return redirect()->back()->withErrors('Max stats is ' . $maxPoints . '!');
            } elseif ($dl === 0 && $request->com != 0) {
                return redirect()->back()->withErrors('Тhe character doesn\'t use a command');
            } elseif ($request->str < 0 or $request->agi < 0 or $request->vit < 0 or $request->ene < 0 or $request->com < 0) {
                return redirect()->back()->withErrors('Invalid symbols');
            } elseif ($online == 'Online') {
                return redirect()->back()->withErrors('Leave game first!');
            } // Update
            else {
                Character::where('Name', $character)
                    ->update($dataToUpdate);
            }

            return redirect()->back()->withSuccess('You have add stats successfully!');
        }
    }
}
