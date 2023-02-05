<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Registration page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function registration()
    {
        return view('registration');
    }

    /**
     * save user post data
     *
     * @return \Illuminate\Contracts\Support\Renderable
    */
    public function save_user(Request $request){
        $this->validate($request, [
			'name'                          => 'required',
			'email'                         => 'required|unique:users|max:191',
			'phone'                         => 'required',
			'password'                      => 'required|min:6|confirmed',
			'password_confirmation'         => 'required|min:6',
            'customer_or_tradesperson'      => 'required',
        ],[
            'name.required' => 'Please enter your name',
            'email.required' => 'Please enter your email',
            'phone.required' => 'Please enter your phone',
            'password.required' => 'Please enter your password',
            'password_confirmation.required' => 'Please enter your confirm password',
            'customer_or_tradesperson.required' => 'Please choose whether you are a Customer or a Tradeperson',
        ]);

        $user = new User();
            $user->name                      = $request['name'];
            $user->email                     = $request['email'];
            $user->phone                     = $request['phone'];
            $user->password                  = Hash::make($request['password']);
            $user->customer_or_tradesperson  = $request['customer_or_tradesperson'];
            $user->phone                     = $request['phone'];
            $user->steps_completed           = 1;
            $user->status                    = 'Active';
            $user->save();
            return redirect()->back()->with('message', 'Thanks for signing up. Welcome to our fixmybuild. We are happy to have you on board.');
    }

}
