<?php

namespace App\Http\Controllers;


use App\Models\MEMB_INFO;
use App\Models\XWEB_CREDITS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class doController extends Controller
{
    public function doRegister(Request $request)
    {
        /* Validation */
        $request->validate([
            'login' => 'min:5|max:10|unique:MEMB_INFO,memb___id',
            'mail' => 'email|unique:MEMB_INFO,mail_addr',
            'c-mail' => 'same:mail',
            'pass' => 'min:9',
            'c-pass' => 'same:pass',
            'checkbox' => 'required'
        ], [
            'c-pass.same' => 'The password confirmation does not match the password.',
            'c-mail.same' => 'The mail confirmation does not match the mail.'
        ]);

        /* Insert Account */
        MEMB_INFO::insert([
            'memb___id' => $request->login,
            'memb__pwd' => $request->pass,
            'memb_name' => $request->login,
            'sno__numb' => 111111111,
            'mail_addr' => $request->mail,
            'bloc_code' => 0,
            'ctl1_code' => 0,
            'reg_date' => now(),
        ]);

        /* Insert Credits */
        XWEB_CREDITS::insert([
           'name' => $request->login,
           'credits' => 0
        ]);
        return redirect()->back()->withSuccess('Thanks ' .$request->login. ' your registration was successful');
    }




    public function doLogin(Request $request)
    {
        $userLogin = MEMB_INFO::userLogin($request->login, $request->password);


        if ($userLogin) {
            $request->session()->put('User', $userLogin->memb___id);
            return redirect('account-panel');
        }
        else
        {
            return redirect()->back()->with('errors','Wrong password or account doesn\'t exist');
        }


    }

    public function doLogout()
    {

        Session::flush();
        return redirect('login');

    }
}



