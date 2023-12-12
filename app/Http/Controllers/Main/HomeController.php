<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Character;
use App\Models\Guild;
use App\Models\Units;
use App\Models\XWEB_NEWS;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
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

        return view('pages.index', [
            'topCharacters' => $topCharacters,
            'topGuilds' => $topGuilds,
            'news' => $news,
            'events' => $events,
            'updates' => $updates,
        ]);
    }
}
