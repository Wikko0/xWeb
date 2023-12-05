<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\MEMB_INFO;
use App\Models\Units;
use App\Models\User;
use App\Models\XWEB_ADDSTATS;
use App\Models\XWEB_CHAR_INFO;
use App\Models\XWEB_CREDITS;
use App\Models\XWEB_GRANDRESET;
use App\Models\XWEB_PKCLEAR;
use App\Models\XWEB_RENAME;
use App\Models\XWEB_RESET;
use App\Models\XWEB_RESETSTATS;
use App\Models\XWEB_VOTE;
use App\Models\XWEB_VOTE_PACKAGE;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Session\Session;

class UserController extends Controller
{

    public function reset()
    {

        $data = ['char' => Character::where('AccountID', '=', session('User'))->get()];
        return view('user.reset', $data);

    }

    public function doReset(Request $request)
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


    public function addStats()
    {

        $data = ['char' => Character::where('AccountID', '=', session('User'))->get()];
        return view('user.add-stats', $data);

    }

    public function doAddStats(Request $request)
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

    public function grandReset()
    {

        $data = ['char' => Character::where('AccountID', '=', session('User'))->get()];
        return view('user.grandreset', $data);

    }

    public function doGrandReset(Request $request)
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


    public function clearPk()
    {

        $char = Character::where('AccountID', '=', session('User'))->get();
        return view('user.clearpk', ['char' => $char, 'pk' => new Units()]);

    }

    public function doClearPk(Request $request)
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

    public function reName()
    {

        $char = Character::where('AccountID', '=', session('User'))->get();
        return view('user.rename', ['char' => $char]);

    }

    public function doReName(Request $request)
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

    public function resetStats()
    {

        $char = Character::where('AccountID', '=', session('User'))->get();
        return view('user.resetstats', ['char' => $char]);

    }

    public function doResetStats(Request $request)
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

    public function buyCredits()
    {

        return view('user.buycredits');

    }

    public function buyVip()
    {

        return view('user.buyvip');

    }

    public function voteReward()
    {
        $output = [];
        $vote = XWEB_VOTE_PACKAGE::get();

        foreach ($vote as $value) {
            $test = XWEB_VOTE::where([
                ['account', session('User')],
                ['time', '>', time()],
                ['voteid', $value->id]
            ])->orderBy('id')->first();

            $remainingTime = $test ? $test->time - time() : 0;

            $output[] = '<form action="'.route('vote-reward').'" method="post" id="vote-form-'.$value->id.'">'.
                '<input type="hidden" name="_token" value="'.csrf_token().'" />'.

                '<input type="hidden" name="id" value="'.$value->id.'">'.
                '<input type="hidden" name="zen" value="'.$value->zen.'">'.
                '<input type="hidden" name="credits" value="'.$value->credits.'">'.
                '<input type="hidden" name="time" value="'.$value->time.'">'.
                '<div class="vote-heading">'.
                '<h4 class="vote-title">'.

                '<span><img src="images/'.$value->image.'" width="80px;" height="50px;"></span>'.
                '<span>'.$value->credits.' Credits</span>'.
                '<span>'.$value->zen.' Zen</span>'.
                '<span>'.$value->time.'h Time</span>';

            if ($test) {
                if ($remainingTime > 0) {
                    $remainingHours = floor($remainingTime / 3600);
                    $remainingMinutes = floor(($remainingTime % 3600) / 60);
                    $remainingSeconds = $remainingTime % 60;

                    $remainingTimeFormatted = '';
                    if ($remainingHours > 0) {
                        $remainingTimeFormatted .= $remainingHours . 'h ';
                    }
                    if ($remainingMinutes > 0) {
                        $remainingTimeFormatted .= $remainingMinutes . 'm ';
                    }
                    if ($remainingSeconds > 0) {
                        $remainingTimeFormatted .= $remainingSeconds . 's';
                    }

                    $output[] = '<span id="countdown-'.$value->id.'" class="votebuttonalready countdown">'.$remainingTimeFormatted.'</span>';
                    $output[] = '<script>' .
                        'let remainingTime'.$value->id.' = ' . $remainingTime . ';' .
                        'let countdownInterval'.$value->id.' = setInterval(function() {' .
                        '   if (remainingTime'.$value->id.' <= 0) {' .
                        '       clearInterval(countdownInterval'.$value->id.');' .
                        '       document.getElementById("countdown-'.$value->id.'").innerHTML = "Time Expired";' .
                        '   } else {' .
                        '       let remainingHours'.$value->id.' = Math.floor(remainingTime'.$value->id.' / 3600);' .
                        '       let remainingMinutes'.$value->id.' = Math.floor((remainingTime'.$value->id.' % 3600) / 60);' .
                        '       let remainingSeconds'.$value->id.' = remainingTime'.$value->id.' % 60;' .
                        '       let remainingTimeFormatted'.$value->id.' = "";' .
                        '       if (remainingHours'.$value->id.' > 0) {' .
                        '           remainingTimeFormatted'.$value->id.' += remainingHours'.$value->id.' + "h ";' .
                        '       }' .
                        '       if (remainingMinutes'.$value->id.' > 0) {' .
                        '           remainingTimeFormatted'.$value->id.' += remainingMinutes'.$value->id.' + "m ";' .
                        '       }' .
                        '       if (remainingSeconds'.$value->id.' > 0) {' .
                        '           remainingTimeFormatted'.$value->id.' += remainingSeconds'.$value->id.' + "s";' .
                        '       }' .
                        '       document.getElementById("countdown-'.$value->id.'").innerHTML = remainingTimeFormatted'.$value->id.';' .
                        '       remainingTime'.$value->id.'--;' .
                        '   }' .
                        '}, 1000);' .
                        '</script>';
                }
            } else {
                $output[] = '<a href="'.$value->link.'" onclick="document.getElementById(\'vote-form-'.$value->id.'\').submit();" target="_blank"><p class="votebutton">VOTE</p></a>';
            }

            $output[] = '</h4>'.
                '</div>'.
                '</form>';
        }

        return view('user.votereward', ['output' => $output]);
    }

    public function doVoteReward(Request $request)
    {
        $id = $request->id;
        $account = MEMB_INFO::where('memb___id', session('User'))->first();
        $credits = XWEB_CREDITS::findByAccount($account->memb___id);
        $vote = XWEB_VOTE::where([
            ['account', session('User')],
            ['voteid', $id]
        ])->first();
        $warehouse = DB::table('warehouse')->where('AccountID', $account->memb___id)->first();
        $newMoney = ($warehouse->Money ?? 0) + $request->zen;

        $newCredits = $credits->credits + $request->credits;

        $time = $request->time * 3600;
        $newTime = $time + time();
        $checkTime = $vote ? $vote->time - time() : 0;

        if (!$warehouse) {
            return redirect()->back()->withErrors('You don\'t have warehouse yet!');
        } elseif ($checkTime > 0) {
            return redirect()->back()->withErrors('You have already voted in the last ' .$request->time. ' hours.');
        } elseif ($newMoney > 2147483647) {
        return redirect()->back()->withErrors('Warehouse money is full.');
        } else {
            XWEB_VOTE::insert([
                'voteid' => $id,
                'account' => session('User'),
                'time' => $newTime,
                'ip' => $_SERVER['REMOTE_ADDR']
            ]);

            DB::table('warehouse')->where('AccountID', $account->memb___id)
                ->update([
                    'Money' => $newMoney,
                ]);

            $credits->update([
                'credits' => $newCredits
            ]);
        }

        return redirect()->back()->withSuccess('You have voted successfully!');
    }

}
