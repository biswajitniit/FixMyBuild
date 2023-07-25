<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cms;
use App\Models\Terms;

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

    public function about_us(){
        return view('cms.about-us');
    }
    public function contact_us(){
        return view('cms.contact-us');
    }
    public function privacy_policy(){
        return view('cms.privacy-policy');
    }
    public function terms_of_service(){
        return view('cms.terms-of-service');
    }

    public function termspage(){
        return view('cms.terms');
    }

    public function website_terms(){
        return view('cms.website-terms');
    }

    public function acceptable_use_policy(){
        return view('cms.acceptable-use-policy');
    }

    public function complaints(){
        return view('cms.complaints');
    }

}
