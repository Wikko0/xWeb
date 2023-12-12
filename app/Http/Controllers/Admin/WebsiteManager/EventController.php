<?php

namespace App\Http\Controllers\Admin\WebsiteManager;

use App\Helpers\EventHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use function redirect;
use function view;

class EventController extends Controller
{
    public function index(): View
    {
        return view('pages.WebsiteManager.event');
    }

    public function doEvent(Request $request): RedirectResponse
    {
        EventHelper::updateEvents($request, "event_config.json");

        return redirect()->back()->withSuccess('You have added this event successfully!');
    }

    public function eventDelete(Request $request)
    {

       EventHelper::deleteEvents($request->name, "event_config.json");

        return redirect()->back()->withSuccess('You have deleted this event successfully!');
    }
}
