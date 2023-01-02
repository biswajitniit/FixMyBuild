<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserdashboardController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }

    public function user_dashboard()
    {


        return view('dashboardarea.user-dashboard');


    }


}
