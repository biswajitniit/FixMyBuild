<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Auth;
class LogoutController extends Controller
{

    public function __construct()
    {
		$this->middleware('auth:admin');

    }

	public function adminlogout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->intended('/admin');
    }

}
