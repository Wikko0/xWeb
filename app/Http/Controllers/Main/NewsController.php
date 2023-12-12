<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\XWEB_NEWS;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(): View
    {
        $news = XWEB_NEWS::getNews(5);
        $events = XWEB_NEWS::getEvents(5);
        $updates = XWEB_NEWS::getUpdates(5);

        return view('news', [
            'news'=> $news,
            'events'=> $events,
            'updates'=> $updates
        ]);
    }
}
