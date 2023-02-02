<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class LogoutsController extends Controller
{
    /**
     * Log out account user.
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function logout(Request $request)
    {

        Session::flush();

        Auth::logout();

        return redirect('/');

        // $this->guard()->logout();
        // Auth::logout();
        // Session::flush();
        // Session::regenerate();
        // return redirect('/login');
    }
}
