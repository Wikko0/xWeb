<?php

namespace App\Http\Controllers\Main\User;

use App\Http\Controllers\Controller;
use App\Models\Character;
use App\Models\User;
use App\Models\XWEB_CREDITS;
use App\Models\XWEB_RENAME;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use function redirect;
use function view;

class RenameController extends Controller
{
    public function index(): View
    {
        return view('user.rename');
    }

    public function doRename(Request $request): RedirectResponse
    {
        $character = $request->input('char');

        if (empty($character)) {
            return redirect()->back()->withErrors('Choose character first!');
        }

        $request->validate([
            'name' => 'unique:Character,Name|min:3|max:8'
        ]);

        $online = User::getStatus($character);
        $selectedCharacter = Character::findByName($character);
        $fee = XWEB_RENAME::first();
        $credits = XWEB_CREDITS::findByAccount($selectedCharacter->AccountID);
        $cost = $credits->credits - $fee->credits;
        $newName = $request->name;

        // Verification
        if ($cost < 0) {
            return redirect()->back()->withErrors('You don\'t have enough credits!');
        } elseif ($online == 'Online') {
            return redirect()->back()->withErrors('Leave game first!');
        }
        // Update
        else {

            Character::where('Name', $character)
                ->update([
                    'Name' => $newName
                ]);

            $credits
                ->update([
                    'credits' => $cost
                ]);
        }

        return redirect()->back()->withSuccess('You have rename this character successfully!');
    }
}
