<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    protected $table = 'users';
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login()
    {
        return view('auth.login');
    }

    public function loginpost(Request $request)
    {

        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required'
        ]);

		if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => 'Active'])) {
            if (Auth::user()->customer_or_tradesperson == "Customer")
            {
                // The user is logged in Customer...
               // return redirect()->intended('/customer/profile');
               return redirect()->intended('/');
            }else{
                if(Auth::user()->steps_completed == 1){
                    return redirect()->intended('/tradeperson/company-registration');
                }else if(Auth::user()->steps_completed == 2){
                    return redirect()->intended('/tradeperson/bank-registration');
                }else if(Auth::user()->steps_completed == 3){
                    return redirect()->intended('/tradeperson/dashboard');
                }
            }
		}
		$errors = new MessageBag(['loginerror' => ['Email and/or password invalid.']]);
		return Redirect::back()->withErrors($errors)->withInput($request->only('email'));
    }

}
