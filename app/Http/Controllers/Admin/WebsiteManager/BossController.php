<?php

namespace App\Http\Controllers\Admin\WebsiteManager;

use App\Helpers\EventHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use function redirect;
use function view;

class BossController extends Controller
{
    public function index(): View
    {
        return view('ap.boss');
    }

    public function doBoss(Request $request): RedirectResponse
    {
        EventHelper::updateEvents($request, "boss_config.json");

        return redirect()->back()->withSuccess('You have added this boss successfully!');
    }

    public function bossDelete(Request $request)
    {

        EventHelper::deleteEvents($request, "boss_config.json");

        return redirect()->back()->withSuccess('You have deleted this boss successfully!');
    }
}
