<?php

namespace App\Http\Controllers\Admin\AddSystem;

use App\Http\Controllers\Controller;
use App\Models\XWEB_VOTE_PACKAGE;
use File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use function public_path;
use function redirect;
use function view;

class VoteController extends Controller
{
    public function index(): View
    {
        $db = ['votereward' => XWEB_VOTE_PACKAGE::get()];
        return view('ap.votereward', $db);
    }

    public function doVoteReward(Request $request): RedirectResponse
    {
        /* Validation */
        $request->validate([
            'image' => 'dimensions:min_width=70,min_height=25,max_width=100,max_height=60|mimes:jpg,png,gif|required|max:10000',
            'link' => 'url|required',
            'zen' => 'required',
            'credits' => 'required',
            'time' => 'required',
        ], ['image.dimensions' => 'Image must be at least 70 x 25 & maximum 100 x 60 pixels']);

        $id = XWEB_VOTE_PACKAGE::latest('id')->first();
        $last = $id->id ?? 0;
        $next_id = ++$last;
        $name = 'vote-img' . $next_id;
        $makeExtension = $request->file('image')->getClientOriginalExtension();

        /* Update */
        XWEB_VOTE_PACKAGE::insert([
            'image' => $name.'.'.$makeExtension,
            'link' => $request->link,
            'zen' => $request->zen,
            'credits' => $request->credits,
            'time' => $request->time,
        ]);



        $makeImage = $request->file('image');

        $makeImage->move(public_path() . '/images/', $name .'.'. $makeExtension);

        return redirect()->back()->withSuccess('You have added this package successfully!');
    }

    public function voteRewardDelete(Request $request): RedirectResponse
    {
        $name = $request->image;
        $ImagePath = public_path('images/' . $name);
        if (File::exists($ImagePath)) {
            File::delete($ImagePath);
        }
        foreach ($request->id as $key => $items) {
            XWEB_VOTE_PACKAGE::
            where('id', $items)
                ->delete();
        }


        return redirect()->back()->withSuccess('Successfully deleted package!');
    }
}
