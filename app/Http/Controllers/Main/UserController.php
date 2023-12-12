<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Character;
use App\Models\GuildMember;
use App\Models\User;
use App\Models\XWEB_CHAR_INFO;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index($username): View
    {
        $user = Character::findByNameOrFail($username);
        $grandResets = XWEB_CHAR_INFO::findByName($username);
        $status = User::getStatus($username);
        $class = User::class($user->Class);
        $map = User::map($user->MapNumber);
        $guild = GuildMember::getGuildByUsername($username);
        $background = User::background($user->Class);

        return view('user', [
            'user' => $user,
            'class' => $class,
            'grandResets' => $grandResets,
            'status' => $status,
            'map' => $map,
            'guild' => $guild,
            'background' => $background
        ]);
    }
}
