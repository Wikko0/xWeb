<?php

namespace App\Http\Controllers\Admin\AddSystem;

use App\Http\Controllers\Controller;
use App\Models\XWEB_NEWS;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use function redirect;
use function view;

class NewsController extends Controller
{
    public function news(): View
    {
        return view('ap.news');
    }

    public function events(): View
    {
        return view('ap.events');
    }

    public function updates(): View
    {
        return view('ap.news');
    }

    private function uploadFrame(Request $request, $specific): void
    {
        /* Validation */
        $request->validate([
            'title' => 'required',
            'news' => 'required',
            'prefix' => 'required',
        ]);

        /* Today */
        $today = date('Y-m-d');

        /* Update */
        XWEB_NEWS::insert([
            'date' => $today,
            'subject' => $request->title,
            'news' => $request->news,
            'prefix' => $request->prefix,
            'specific' => $specific
        ]);

    }

    private function deleteFrame(Request $request, $model): void
    {
        foreach ($request->id as $key => $id) {

            $model::
            where('id', $id)
                ->delete();
        }
    }

    public function newsUpload(Request $request): RedirectResponse
    {
        $this->uploadFrame($request, 'news');

        return redirect()->back()->withSuccess('You have added this news successfully!');
    }

    public function newsDelete(Request $request): RedirectResponse
    {

        $this->deleteFrame($request, XWEB_NEWS::class);

        return redirect()->back()->withSuccess('You have deleted this news successfully!');
    }

    public function eventsUpload(Request $request): RedirectResponse
    {
        $this->uploadFrame($request, 'events');

        return redirect()->back()->withSuccess('You have added this events successfully!');
    }

    public function eventsDelete(Request $request): RedirectResponse
    {

        $this->deleteFrame($request, XWEB_NEWS::class);

        return redirect()->back()->withSuccess('You have deleted this events successfully!');
    }

    public function updatesUpload(Request $request): RedirectResponse
    {
        $this->uploadFrame($request, 'updates');

        return redirect()->back()->withSuccess('You have added this updates successfully!');
    }

    public function updatesDelete(Request $request): RedirectResponse
    {

        $this->deleteFrame($request, XWEB_NEWS::class);

        return redirect()->back()->withSuccess('You have deleted this updates successfully!');
    }
}
