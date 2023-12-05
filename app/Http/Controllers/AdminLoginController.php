<?php

namespace App\Http\Controllers;

use App\Models\XWEB_ADMINLOGIN;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    public function adminLogin()
    {
        return view('ap.login');
    }


    public function doAdminLogin(Request $request)
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
