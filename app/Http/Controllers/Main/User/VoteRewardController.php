<?php

namespace App\Http\Controllers\Main\User;

use App\Http\Controllers\Controller;
use App\Models\MEMB_INFO;
use App\Models\XWEB_CREDITS;
use App\Models\XWEB_VOTE;
use App\Models\XWEB_VOTE_PACKAGE;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use function csrf_token;
use function redirect;
use function route;
use function session;
use function view;

class VoteRewardController extends Controller
{
    public function index(): View
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

    public function doVoteReward(Request $request): RedirectResponse
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
