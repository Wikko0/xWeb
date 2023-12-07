<?php

namespace App\Http\Controllers\Admin\PaymentSystem;

use App\Http\Controllers\Controller;
use App\Models\XWEB_PAYPAL;
use App\Models\XWEB_PAYPAL_PACKAGE;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use function redirect;
use function view;

class PaypalController extends Controller
{
    public function index(): View
    {
        $db = ['paypal' => XWEB_PAYPAL::get()];
        return view('ap.paypal', $db);
    }

    public function doPaypal(Request $request): RedirectResponse
    {
        /* Validation */
        $request->validate([
            'client_id' => 'required',
            'client_secret' => 'required',
            'currency' => 'required',
        ]);

        /* Update */
        XWEB_PAYPAL::where('id', $request->id)
            ->update([
                'client_id' => $request->client_id,
                'client_secret' => $request->client_secret,
                'currency' => $request->currency
            ]);

        return redirect()->back()->withSuccess('You have changed Paypal settings successfully!');
    }

    public function paypalPack(): View
    {
        $db = ['paypal_pack' => XWEB_PAYPAL_PACKAGE::get()];
        return view('ap.paypal_pack', $db);
    }

    public function doPaypalPack(Request $request): RedirectResponse
    {
        /* Validation */
        $request->validate([
            'name' => 'unique:XWEB.XWEB_PAYPAL_PACKAGE,name',
            'amount' => 'required',
            'credits' => 'required',
        ]);

        /* Update */
        XWEB_PAYPAL_PACKAGE::
        insert([
            'name' => $request->name,
            'amount' => $request->amount,
            'credits' => $request->credits
        ]);


        return redirect()->back()->withSuccess('You have added this package successfully!');
    }

    public function paypalPackDelete(Request $request): RedirectResponse
    {

        foreach ($request->id as $items) {

            XWEB_PAYPAL_PACKAGE::where('id', $items)
                ->delete();
        }

        return redirect()->back()->withSuccess('Successfully deleted package!');
    }
}
