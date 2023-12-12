<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\MEMB_INFO;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function index(): View
    {
        return view('login');
    }

    public function doLogin(Request $request): RedirectResponse
    {
        $userLogin = MEMB_INFO::userLogin($request->login, $request->password);


        if ($userLogin) {
            $request->session()->put('User', $userLogin->memb___id);
            return redirect('account-panel');
        }
        else
        {
            return redirect()->back()->withErrors('Wrong password or account doesn\'t exist');
        }


    }

    public function doLogout(): RedirectResponse
    {

        Session::flush();
        return redirect('login');

    }
}
