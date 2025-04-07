<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    //
    public function create_session(Request $request)
    {

        // penggunaan session bisa langsung:
        // session()
        // penggunaan session bisa dari illuminate support facades session
        // Session::put()
        // penggunaan session bisa dari method request
        $request->session()->put('userId', 'Hanif');
        $request->session()->put('isMember', 'true');

        return "OK";
    }

    public function get_session(Request $request)
    {
        $userId = $request->session()->get('userId', 'guest');
        $isMember = $request->session()->get('isMember', "false");

        return "User Id: $userId, Is Member: $isMember";
    }
}
