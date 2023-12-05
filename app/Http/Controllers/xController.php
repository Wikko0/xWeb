<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Guild;
use App\Models\GuildMember;
use App\Models\MEMB_INFO;
use App\Models\MEMB_STAT;
use App\Models\Units;
use App\Models\XWEB_ADMINLOGIN;
use App\Models\XWEB_CHAR_INFO;
use App\Models\XWEB_CHARACTERS;
use App\Models\XWEB_CREDITS;
use App\Models\XWEB_DOWNLOAD;
use App\Models\XWEB_NEWS;
use App\Models\XWEB_VIP;
use Illuminate\Http\Request;
use App\Models\User;

class xController extends Controller
{

    public function index()
    {

        $selectedCharacters = Character::getTopCharacters(5);
        $selectedGuilds = Guild::getTopGuilds(5);

        $topCharacters = "";
        foreach ($selectedCharacters as $index => $character) {
            $row = Units::generateCharacterTop5Row($index, $character);
            $topCharacters .= $row;
        }

        $topGuilds = "";
        foreach ($selectedGuilds as $index => $guild) {
            $guildRow = Units::generateGuildRow($index, $guild);
            $topGuilds .= $guildRow;
        }

        $news = XWEB_NEWS::getNews(5);
        $events = XWEB_NEWS::getEvents(5);
        $updates = XWEB_NEWS::getUpdates(5);

        return view('index', [
            'topCharacters' => $topCharacters,
            'topGuilds' => $topGuilds,
            'news' => $news,
            'events' => $events,
            'updates' => $updates,
        ]);
    }

    public function register()
    {
        return view('register');
    }

    public function login()
    {
        return view('login');
    }

    public function accountPanel()
    {
        $userInfo = MEMB_INFO::where('memb___id', '=', session('User'))->first();
        $select = Character::where('AccountID', '=', session('User'))->get();
        $adminCheck = XWEB_ADMINLOGIN::first();
        $vipCheck = XWEB_VIP::where('account', session('User'))->first();
        $credits = XWEB_CREDITS::where('name', session('User'))->first();

        // Output
        $output = "";
        foreach ($select as $index => $character) {
            $row = Units::generateCharacterPanel($index, $character);
            $output .= $row;

        }

        // Rank
        $rank = ($adminCheck->admin == session('User')) ? 'Administrator' : 'User';

        // Vip
        $expires = $vipCheck->expires ?? 'Expired';
        $account = $vipCheck->account ?? 0;
        $vip = ($expires != 'Expired' && $account == session('User')) ? 'Activated' : 'None (<a href="' . route('buyvip') . '">Buy Now</a>)';

        return view('user.account-panel',
            [
                'userInfo' => $userInfo,
                'output' => $output,
                'rank' => $rank,
                'vip' => $vip,
                'vipCheck' => $vipCheck,
                'credits' => $credits
            ]);
    }

    public function download()
    {
        $mb = ['lite'=> XWEB_DOWNLOAD::where('version', '=', 'lite')->first('mb'),
            'full'=> XWEB_DOWNLOAD::where('version', '=', 'full')->first('mb')];

        $data = ['litelink'=> XWEB_DOWNLOAD::where('version', '=', 'lite')->get(),
            'fulllink'=> XWEB_DOWNLOAD::where('version', '=', 'full')->get(),
            'update'=> XWEB_DOWNLOAD::where('version', '=', 'update')->get()];
        return view('download', $mb, $data);
    }

    public function ranking(Request $request)
    {

        $selectedCharacters = Character::getTopCharacters(15);

        $search = $request->input('search');
        $searchBy = $request->input('searchBy');

        if (isset($search)) {
            $selectedCharacters = Character::searchByName($search, 15);
        }
        if (isset($searchBy)) {
            $selectedCharacters = Character::searchByClass($searchBy, 15);
        }

        $output = '';
        foreach ($selectedCharacters as $index => $row) {
            $row = Units::generateCharacterRow($index, $row);
            $output .= $row;
        }

        return view('ranking', [
            'output' => $output,
            'selectedCharacters' => $selectedCharacters
        ]);
    }

    public function news()
    {
        $news = XWEB_NEWS::getNews(5);
        $events = XWEB_NEWS::getEvents(5);
        $updates = XWEB_NEWS::getUpdates(5);

        return view('news', ['news'=> $news, 'events'=> $events, 'updates'=> $updates]);
    }

    public function information()
    {
        $countChar = Character::count();
        $countAcc = MEMB_INFO::count();
        $countGuild = Guild::count();
        $countOnline = MEMB_STAT::where('ConnectStat', 1)->count();
        return view('information',['countAcc' => $countAcc,'countChar' => $countChar,'countGuild' => $countGuild,'countOnline' => $countOnline]);

    }


    public function user($username)
    {
        $user = Character::findByNameOrFail($username);
        $grandResets = XWEB_CHAR_INFO::findByName($username);
        $status = User::getStatus($username);
        $class = User::class($user->Class);
        $map = User::map($user->MapNumber);
        $guild = GuildMember::getGuildByUsername($username);
        $background = User::background($user->Class);

        return view('user', ['user' => $user, 'class' => $class, 'grandResets' => $grandResets, 'status' => $status, 'map' => $map, 'guild' => $guild, 'background' => $background]);
    }
}
