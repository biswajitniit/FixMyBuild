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
        $cms = Cms::where('cms_pagename','about-us')->first();
        return view('cms.about-us',compact('cms'));
    }
    public function contact_us(){
        $cms = Cms::where('cms_pagename','contact-us')->first();
        return view('cms.contact-us',compact('cms'));
    }
    public function privacy_policy(){
        $cms = Cms::where('cms_pagename','privacy-policy')->first();
        return view('cms.privacy-policy',compact('cms'));
    }
    public function terms_of_service(){
        $cms = Cms::where('cms_pagename','terms-of-service')->first();
        return view('cms.terms-of-service',compact('cms'));
    }

    public function termspage(Request $request, $pageid){
        $terms = Terms::where('id',$pageid)->first();
        $termspagename = Terms::where('status','Active')->get();
        return view('cms.terms',compact('terms','termspagename'));
    }

}
