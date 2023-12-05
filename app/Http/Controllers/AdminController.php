<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\MEMB_INFO;
use App\Models\MEMB_STAT;
use App\Models\XWEB_ADD_INFORMATION;
use App\Models\XWEB_ADDSTATS;
use App\Models\XWEB_ADMINCP;
use App\Models\XWEB_ADMINLOGIN;
use App\Models\XWEB_ANNOUNCE;
use App\Models\XWEB_DOWNLOAD;
use App\Models\XWEB_GRANDRESET;
use App\Models\XWEB_CHARACTERS;
use App\Models\XWEB_INFORMATION;
use App\Models\XWEB_NEWS;
use App\Models\XWEB_PAYPAL;
use App\Models\XWEB_PAYPAL_PACKAGE;
use App\Models\XWEB_PKCLEAR;
use App\Models\XWEB_RENAME;
use App\Models\XWEB_RESET;
use App\Models\XWEB_RESETSTATS;
use App\Models\XWEB_SLIDERS;
use App\Models\XWEB_VIP_PACKAGE;
use App\Models\XWEB_VOTE_PACKAGE;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;
use App\Rules\SepareteTime;
use Illuminate\Validation\Validator;
use File;

class AdminController extends Controller
{
    public function dashboard()
    {

            $accinfo = MEMB_INFO::count();
            $charInfo = Character::count();
            $online = MEMB_STAT::where('ConnectStat', 1)->count();
            $today = MEMB_STAT::where([
                ['ConnectStat', 1],
                ['ConnectTM', '>', Carbon::now()->subDays(1)],
            ])->count();

            return view('ap.home', ['accinfo' => $accinfo, 'charInfo' => $charInfo, 'online' => $online, 'today' => $today]);

    }

    public function panel()
    {
        return view('ap.adminlogin');
    }

    public function doPanel(Request $request)
    {
        XWEB_ADMINLOGIN::where('id', $request->id)->update(['admin' => $request->name, 'password' => $request->password]);

        return redirect()->back()->withSuccess('You have changed admin user successfully!');
    }

    public function serverInformation()
    {
        return view('ap.server_information');
    }

    public function doServerInformation(Request $request)
    {
        XWEB_ADMINCP::where('id', $request->id)->update(['sname' => $request->sname, 'stitle' => $request->stitle, 'sdescription' => $request->sdescription,
            'skeywords' => $request->skeywords, 'surl' => $request->surl, 'sforum' => $request->sforum, 'sdiscord' => $request->sdiscord]);

        return redirect()->back()->withSuccess('You have changed server information successfully!');
    }

    public function announce()
    {
        $select = XWEB_ANNOUNCE::first();
        return view('ap.announce', ['announce_config' => $select]);
    }

    public function doAnnounce(Request $request)
    {

        XWEB_ANNOUNCE::updateOrCreate(
            ['row' => 1],
            ['status' => $request->status, 'date' => $request->date, 'title' => $request->title]);
        return redirect('adminpanel/announce');
    }

    public function download()
    {
        return view('ap.download');
    }

    public function doDownload(Request $request)
    {
        $request->validate([
            'name' => 'unique:XWEB.XWEB_DOWNLOAD,name',
            'link' => 'active_url',
            'mb' => 'max:15'
        ]);

         XWEB_DOWNLOAD::
            insert(['mb' => $request->mb, 'name' => $request->name, 'version' => $request->version, 'link' => $request->link,
                'site' => $request->site]);


        return redirect()->back()->withSuccess('You have added this download link successfully!');
    }

    public function downloadDelete(Request $request)
    {

        foreach ($request->id as $key => $items) {

            XWEB_DOWNLOAD::where('id', $items)
                ->delete();
        }

        return redirect()->back()->withSuccess('Successfully deleted download link!');
    }

    public function event()
    {
        return view('ap.event');
    }

    public function doEvent(Request $request)
    {
        $request->validate([
            'everyday' => [new SepareteTime(), 'nullable'],
            'monday' => [new SepareteTime(), 'nullable'],
            'tuesday' => [new SepareteTime(), 'nullable'],
            'wednesday' => [new SepareteTime(), 'nullable'],
            'thursday' => [new SepareteTime(), 'nullable'],
            'friday' => [new SepareteTime(), 'nullable'],
            'saturday' => [new SepareteTime(), 'nullable'],
            'sunday' => [new SepareteTime(), 'nullable'],

        ]);

        $decode = json_decode(file_get_contents(storage_path() . "/app/public/event_config.json"), true);


        foreach ($decode['events']['event_timers'] as $value) {
            $name = $request->event;
            $days = $request->days;
            if (in_array(0, $days)) {
                $days = 0;
            }
            if ($days == 0) {
                $time = $request->everyday;
            }
            if (!is_array($days)) {
                $config = ['name' => $name, 'days' => $time];
            } else {
                $d = [];
                foreach ($days as $key => $values) {
                    if ($values == 1)
                        $d[$values] = $request->monday;
                    if ($values == 2)
                        $d[$values] = $request->tuesday;
                    if ($values == 3)
                        $d[$values] = $request->wednesday;
                    if ($values == 4)
                        $d[$values] = $request->thursday;
                    if ($values == 5)
                        $d[$values] = $request->friday;
                    if ($values == 6)
                        $d[$values] = $request->saturday;
                    if ($values == 7)
                        $d[$values] = $request->sunday;
                }

                $config = ['name' => $name, 'days' => $d];
            }
        }
        $new_config = array_push($decode['events']['event_timers'], $config);
        $newJsonString = json_encode($decode);
        file_put_contents(storage_path() . "/app/public/event_config.json", $newJsonString);
        return redirect()->back()->withSuccess('You have added this event successfully!');
    }

    public function eventDelete(Request $request)
    {

        $decode = json_decode(file_get_contents(storage_path() . "/app/public/event_config.json"), true);


        foreach ($decode['events']['event_timers'] as $key => $element) {

            //check the property of every element
            if ($request->name == $element['name']) {
                unset($decode['events']['event_timers'][$key]);
            }

        }

        $newJsonString = json_encode($decode);
        file_put_contents(storage_path() . "/app/public/event_config.json", $newJsonString);
        return redirect()->back()->withSuccess('You have deleted this event successfully!');
    }

    public function boss()
    {
        return view('ap.boss');
    }

    public function doBoss(Request $request)
    {
        $request->validate([
            'everyday' => [new SepareteTime(), 'nullable'],
            'monday' => [new SepareteTime(), 'nullable'],
            'tuesday' => [new SepareteTime(), 'nullable'],
            'wednesday' => [new SepareteTime(), 'nullable'],
            'thursday' => [new SepareteTime(), 'nullable'],
            'friday' => [new SepareteTime(), 'nullable'],
            'saturday' => [new SepareteTime(), 'nullable'],
            'sunday' => [new SepareteTime(), 'nullable'],

        ]);

        $decode = json_decode(file_get_contents(storage_path() . "/app/public/boss_config.json"), true);


        foreach ($decode['events']['event_timers'] as $value) {
            $name = $request->event;
            $days = $request->days;
            if (in_array(0, $days)) {
                $days = 0;
            }
            if ($days == 0) {
                $time = $request->everyday;
            }
            if (!is_array($days)) {
                $config = ['name' => $name, 'days' => $time];
            } else {
                $d = [];
                foreach ($days as $key => $values) {
                    if ($values == 1)
                        $d[$values] = $request->monday;
                    if ($values == 2)
                        $d[$values] = $request->tuesday;
                    if ($values == 3)
                        $d[$values] = $request->wednesday;
                    if ($values == 4)
                        $d[$values] = $request->thursday;
                    if ($values == 5)
                        $d[$values] = $request->friday;
                    if ($values == 6)
                        $d[$values] = $request->saturday;
                    if ($values == 7)
                        $d[$values] = $request->sunday;
                }

                $config = ['name' => $name, 'days' => $d];
            }
        }
        $new_config = array_push($decode['events']['event_timers'], $config);
        $newJsonString = json_encode($decode);
        file_put_contents(storage_path() . "/app/public/boss_config.json", $newJsonString);
        return redirect()->back()->withSuccess('You have added this boss successfully!');
    }

    public function bossDelete(Request $request)
    {

        $decode = json_decode(file_get_contents(storage_path() . "/app/public/boss_config.json"), true);


        foreach ($decode['events']['event_timers'] as $key => $element) {

            //check the property of every element
            if ($request->name == $element['name']) {
                unset($decode['events']['event_timers'][$key]);
            }

        }

        $newJsonString = json_encode($decode);
        file_put_contents(storage_path() . "/app/public/boss_config.json", $newJsonString);
        return redirect()->back()->withSuccess('You have deleted this boss successfully!');
    }

    public function slider()
    {
        $get = XWEB_SLIDERS::get();
        return view('ap.slider', $get);
    }

    public function sliderUpload(Request $request)
    {

        $request->validate([
            'image' => 'dimensions:min_width=884,min_height=374,max_width=884,max_height=374|mimes:jpg|required|max:10000'
        ], ['image.dimensions' => 'Image must be at least 884 x 374 pixels']);

        $id = XWEB_SLIDERS::latest('id')->first();
        $last = $id->id ?? 0;
        $next_id = ++$last;
        $name = 'slider-img' . $next_id;

         XWEB_SLIDERS::insert(['name' => $name]);


        $makeImage = $request->file('image');
        $makeImage->move(public_path() . '/images/', $name . '.jpg');

        return redirect()->back()->withSuccess('You have added this slider successfully!');
    }

    public function sliderDelete(Request $request)
    {

        $name = $request->name;
        $ImagePath = public_path('images/' . $name . '.jpg');
        if (File::exists($ImagePath)) {
            File::delete($ImagePath);
        }
        foreach ($request->id as $key => $items) {
            XWEB_SLIDERS::
                where('id', $items)
                ->delete();
        }


        return redirect()->back()->withSuccess('You have deleted this slider successfully!');
    }

    public function news()
    {
        return view('ap.news');
    }

    public function newsUpload(Request $request)
    {

        $today = date('Y-m-d');
       XWEB_NEWS::
            insert(['date' => $today,
                'subject' => $request->title,
                'news' => $request->news,
                'prefix' => $request->prefix,
                'specific' => 'news']);
        return redirect()->back()->withSuccess('You have added this news successfully!');
    }

    public function newsDelete(Request $request)
    {
        foreach ($request->id as $key => $id) {

           XWEB_NEWS::
                where('id', $id)
                ->delete();
        }

        return redirect()->back()->withSuccess('You have deleted this news successfully!');
    }

    public function events()
    {
        return view('ap.events');
    }

    public function eventsUpload(Request $request)
    {

        $today = date('Y-m-d');
         XWEB_NEWS::
            insert(['date' => $today,
                'subject' => $request->title,
                'news' => $request->news,
                'prefix' => $request->prefix,
                'specific' => 'events']);
        return redirect()->back()->withSuccess('You have added this event news successfully!');
    }

    public function eventsDelete(Request $request)
    {
        foreach ($request->id as $key => $id) {

            XWEB_NEWS::
                where('id', $id)
                ->delete();
        }

        return redirect()->back()->withSuccess('You have deleted this event news successfully!');
    }

    public function updates()
    {
        return view('ap.updates');
    }

    public function updatesUpload(Request $request)
    {

        $today = date('Y-m-d');
        XWEB_NEWS::
            insert(['date' => $today,
                'subject' => $request->title,
                'news' => $request->news,
                'prefix' => $request->prefix,
                'specific' => 'updates']);
        return redirect()->back()->withSuccess('You have added this updates news successfully!');
    }

    public function updatesDelete(Request $request)
    {
        foreach ($request->id as $key => $id) {

            XWEB_NEWS::
                where('id', $id)
                ->delete();
        }

        return redirect()->back()->withSuccess('You have deleted this updates news successfully!');
    }

    public function hof()
    {
        $char = XWEB_CHARACTERS::get();
        return view('ap.hof', ['char' => $char]);
    }

    public function hofAdd(Request $request)
    {
       XWEB_CHARACTERS::
            where('class', '=', $request->class)
            ->update(['name' => $request->name,
                'wins' => $request->wins
            ]);
        return redirect()->back()->withSuccess('You have added this updates HOF successfully!');
    }

    public function character()
    {
        $char = XWEB_CHARACTERS::get();
        return view('ap.character', ['char' => $char]);
    }

    public function doCharacter(Request $request)
    {
        foreach ($request->id as $i => $id) {
            $switch = $request->switch[$i] ?? null;

            if ($switch == true) {
                $switch = "Yes";
            } else {
                $switch = "No";
            }

            XWEB_CHARACTERS::
                where('name', $request->name[$i])
                ->update(
                    [
                        'status' => $switch,
                    ]);
        }

        return redirect()->back()->withSuccess('You have added this updates HOF successfully!');

    }

    public function reset()
    {
        $db = ['reset' => XWEB_RESET::get()];
        return view('ap.reset', $db);
    }

    public function doReset(Request $request)
    {
        XWEB_RESET::
            where('id', $request->id)
            ->update(['maxresets' => $request->maxresets,
                'level' => $request->level,
                'zen' => $request->zen,
                'bkpoints' => $request->bkpoints,
                'smpoints' => $request->smpoints,
                'elfpoints' => $request->elfpoints,
                'mgpoints' => $request->mgpoints,
                'dlpoints' => $request->dlpoints,
                'sumpoints' => $request->sumpoints,
                'rfpoints' => $request->rfpoints,
                'glpoints' => $request->glpoints,

            ]);
        return redirect()->back()->withSuccess('You have changed reset settings successfully!');
    }

    public function addStats()
    {
        $db = ['addstats' => XWEB_ADDSTATS::get()];
        return view('ap.addstats', $db);
    }

    public function doAddStats(Request $request)
    {
        XWEB_ADDSTATS::where('id', $request->id)
            ->update(['maxpoints' => $request->maxpoints

            ]);
        return redirect()->back()->withSuccess('You have changed addstats settings successfully!');
    }

    public function grandReset()
    {
        $db = ['greset' => XWEB_GRANDRESET::get()];
        return view('ap.grandreset', $db);
    }

    public function doGrandReset(Request $request)
    {
        XWEB_GRANDRESET::where('id', $request->id)
            ->update(['maxgresets' => $request->maxgresets,
                'resets' => $request->resets,
                'level' => $request->level,
                'zen' => $request->zen,
                'credits' => $request->credits,

            ]);
        return redirect()->back()->withSuccess('You have changed reset settings successfully!');
    }

    public function pkClear()
    {
        $db = ['pkclear' => XWEB_PKCLEAR::get()];
        return view('ap.pkclear', $db);
    }

    public function doPkClear(Request $request)
    {
        XWEB_PKCLEAR::where('id', $request->id)
            ->update(['zen' => $request->zen
            ]);
        return redirect()->back()->withSuccess('You have changed PK Clear cost settings successfully!');
    }


    public function reName()
    {
        $db = ['rename' => XWEB_RENAME::get()];
        return view('ap.rename', $db);
    }

    public function doReName(Request $request)
    {
        XWEB_RENAME::where('id', $request->id)
            ->update(['credits' => $request->credits
            ]);
        return redirect()->back()->withSuccess('You have changed RENAME cost settings successfully!');
    }

    public function resetStats()
    {
        $db = ['resetstats' => XWEB_RESETSTATS::get()];
        return view('ap.resetstats', $db);
    }

    public function doResetStats(Request $request)
    {
        XWEB_RESETSTATS::where('id', $request->id)
            ->update([
                'credits' => $request->credits,
                'zen' => $request->zen,
                'level' => $request->level,
                'resets' => $request->resets,
            ]);
        return redirect()->back()->withSuccess('You have changed ResetStats cost settings successfully!');
    }

    public function paypal()
    {
        $db = ['paypal' => XWEB_PAYPAL::get()];
        return view('ap.paypal', $db);
    }

    public function doPaypal(Request $request)
    {
        XWEB_PAYPAL::where('id', $request->id)
            ->update([
                'client_id' => $request->client_id,
                'client_secret' => $request->client_secret,
                'currency' => $request->currency
            ]);
        return redirect()->back()->withSuccess('You have changed Paypal settings successfully!');
    }

    public function paypalPack()
    {
        $db = ['paypal_pack' => XWEB_PAYPAL_PACKAGE::get()];
        return view('ap.paypal_pack', $db);
    }

    public function doPaypalPack(Request $request)
    {
       $request->validate([
            'name' => 'unique:XWEB.XWEB_PAYPAL_PACKAGE,name'
        ]);

        XWEB_PAYPAL_PACKAGE::
        insert(['name' => $request->name, 'amount' => $request->amount, 'credits' => $request->credits]);


        return redirect()->back()->withSuccess('You have added this package successfully!');
    }

    public function paypalPackDelete(Request $request)
    {

        foreach ($request->id as $items) {

            XWEB_PAYPAL_PACKAGE::where('id', $items)
                ->delete();
        }

        return redirect()->back()->withSuccess('Successfully deleted package!');
    }

    public function information()
    {
        $db = ['information' => XWEB_INFORMATION::get()];
        return view('ap.information', $db);
    }

    public function doInformation(Request $request)
    {
        XWEB_INFORMATION::where('id', $request->id)
            ->update([
                'sname' => $request->sname,
                'version' => $request->version,
                'experience' => $request->exp,
                'droprate' => $request->drop,
                'zenrate' => $request->zen,
                'ppl' => $request->ppl
            ]);
        return redirect()->back()->withSuccess('You have changed Information successfully!');
    }

    public function addInfo()
    {
        $checkinfo = XWEB_ADD_INFORMATION::get();
        return view('ap.addinfo',['checkinfo' => $checkinfo]);
    }

    public function doAddInfo(Request $request)
    {

        XWEB_ADD_INFORMATION::
        updateOrCreate(
            ['row' => 1],
            ['information' => $request->information]);
        return redirect()->back()->withSuccess('You have added this information successfully!');
    }

    public function vipPack()
    {
        $db = ['vip_pack' => XWEB_VIP_PACKAGE::get()];
        return view('ap.vip_pack', $db);
    }

    public function doVipPack(Request $request)
    {

        XWEB_VIP_PACKAGE::
        insert(['name' => $request->name, 'days' => $request->days, 'credits' => $request->credits]);


        return redirect()->back()->withSuccess('You have added this package successfully!');
    }

    public function vipPackDelete(Request $request)
    {

        foreach ($request->id as $items) {

            XWEB_VIP_PACKAGE::where('id', $items)
                ->delete();
        }

        return redirect()->back()->withSuccess('Successfully deleted package!');
    }

    public function voteReward()
    {
        $db = ['votereward' => XWEB_VOTE_PACKAGE::get()];
        return view('ap.votereward', $db);
    }

    public function doVoteReward(Request $request)
    {

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

    public function voteRewardDelete(Request $request)
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
