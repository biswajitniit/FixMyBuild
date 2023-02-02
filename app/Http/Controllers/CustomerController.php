<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class CustomerController extends Controller
{
    //
    public function customer_newproject(Request $request){
        return view("customer/newproject");
    }

}
