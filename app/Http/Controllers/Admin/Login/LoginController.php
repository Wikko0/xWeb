<?php

namespace App\Http\Controllers\Admin\Login;

use App\Http\Controllers\Controller;
use App\Models\XWEB_ADMINLOGIN;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function index(): View
    {
        return view('pages.Login.login');
    }


    public function doLogin(Request $request): RedirectResponse
    {

        $adminLogin = XWEB_ADMINLOGIN::adminLogin($request->login, $request->password);

        if ($adminLogin) {
            $request->session()->put('Admin', $adminLogin->admin);

            return redirect('adminpanel');

        } else {
            return redirect()->back()->with('errors', 'Wrong password, account doesn\'t exist or you arent Admin');
        }

    }
}
