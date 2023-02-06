<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projectaddresses;
use App\Models\Project;
use App\Models\User;
use App\Models\Projectfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

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
        $project = Project::where('user_id',Auth::user()->id)->get();
        $projecthistory = Project::where('user_id',Auth::user()->id)->where('created_at', '!=', Carbon::today())->get();
        return view("customer/project",compact('project','projecthistory'));
    }
    public function customer_notifications(Request $request){
        return view("customer/notifications");
    }
    public function customer_storeproject(Request $request){

        if($request->choseaddresstype == "chosenewaddress"){

            // $this->validate($request, [
            //     'name'                          => 'required',
            //     'email'                         => 'required|unique:users|max:191',
            //     'phone'                         => 'required',
            //     'password'                      => 'required|min:6|confirmed',
            //     'password_confirmation'         => 'required|min:6',
            //     'customer_or_tradesperson'      => 'required',
            // ],[
            //     'name.required' => 'Please enter your name',
            //     'email.required' => 'Please enter your email',
            //     'phone.required' => 'Please enter your phone',
            //     'password.required' => 'Please enter your password',
            //     'password_confirmation.required' => 'Please enter your confirm password',
            //     'customer_or_tradesperson.required' => 'Please choose whether you are a Customer or a Tradeperson',
            // ]);

            $address = new Projectaddresses();
                $address->user_id           = Auth::user()->id;
                $address->address_line_one  = $request['address_line_one'];
                $address->address_line_two  = $request['address_line_two'];
                $address->town_city         = $request['town_city'];
                $address->postcode          = $request['postcode'];
                $address->save();
            $addressid = $address->id;



            $project = new Project();
                $project->user_id                   = Auth::user()->id;
                $project->project_address_id        = $addressid;
                $project->forename                  = $request['forename'];
                $project->surname                   = $request['surname'];
                $project->project_name              = $request['project_name'];
                $project->description               = $request['description'];
                $project->contact_mobile_no         =  $request['contact_mobile_no'];
                $project->contact_home_phone        =  $request['contact_home_phone'];
                $project->contact_email             =  $request['contact_email'];
                $project->status                    = 'New';
            $project->save();

            return redirect()->back()->with('message', '');

        }else{

        }


    }

}
