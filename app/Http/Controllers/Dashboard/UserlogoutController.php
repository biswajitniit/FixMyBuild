<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserlogoutController extends Controller
{
    public function __construct()
    {
		$this->middleware('auth');

    }

	public function userlogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->intended('/login');
    }

}
