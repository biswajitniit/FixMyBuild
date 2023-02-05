<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class CustomerController extends Controller
{
    //
    public function customer_newproject(Request $request){
        return view("customer/newproject");
    }
    public function customer_profile(Request $request){
        return view("customer/profile");
    }
    public function customer_project(Request $request){
        return view("customer/project");
    }
    public function customer_notifications(Request $request){
        return view("customer/notifications");
    }
}
