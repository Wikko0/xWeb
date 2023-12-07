<?php

namespace App\Http\Controllers\Admin\WebsiteManager;

use App\Http\Controllers\Controller;
use App\Models\XWEB_SLIDERS;
use File;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use function public_path;
use function redirect;
use function view;

class SliderController extends Controller
{
    public function index(): View
    {
        return view('ap.slider');
    }

    public function sliderUpload(Request $request): RedirectResponse
    {
        /* Validation */
        $request->validate([
            'image' => 'dimensions:min_width=884,min_height=374,max_width=884,max_height=374|mimes:jpg|required|max:10000'
        ],
            ['image.dimensions' => 'Image must be at least 884 x 374 pixels']
        );

        /* Get name */
        $id = XWEB_SLIDERS::latest('id')->first();
        $last = $id->id ?? 0;
        $next_id = ++$last;
        $name = 'slider-img' . $next_id;

        /* Insert */
        XWEB_SLIDERS::insert([
            'name' => $name
        ]);


        /* Move image */
        $makeImage = $request->file('image');
        $makeImage->move(public_path() . '/images/', $name . '.jpg');

        return redirect()->back()->withSuccess('You have added this slider successfully!');
    }

    public function sliderDelete(Request $request): RedirectResponse
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

}
