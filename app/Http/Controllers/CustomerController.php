<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projectaddresses;
use App\Models\Project;
use App\Models\User;
use App\Models\Projectfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

use Illuminate\Support\Facades\DB;


use Illuminate\Support\Facades\Storage;
use Session;
use Aws\S3\Exception\S3Exception;
use App\Models\Tempmedia;
use League\Flysystem\File;

class CustomerController extends Controller
{
    public function customer_newproject(Request $request){
        if(Auth::user()->is_email_verified == 0){
            return view("customer/profile");
        }else{
            return view("customer/newproject");
        }
    }
    public function customer_profile(Request $request){
        return view("customer/profile");
    }
    public function customer_project(Request $request){
        $project = Project::where('user_id',Auth::user()->id)->get();
        $projecthistory = Project::where('user_id',Auth::user()->id)->where('created_at', '!=', Carbon::today())->get();
        return view("customer/project",compact('project','projecthistory'));
    }
    // public function customer_notifications(Request $request){
    //     return view("customer/notifications");
    // }
    public function customer_storeproject(Request $request){

        $this->validate($request, [
            'forename'                        => 'required',
            'surname'                         => 'required',
            'project_name'                    => 'required',
            'contact_mobile_no'               => 'required',
            'contact_email'                   => 'required',
        ],[
            'forename.required'          => 'Please enter forename',
            'surname.required'           => 'Please enter surname',
            'project_name.required'      => 'Please enter project name',
            'contact_mobile_no.required' => 'Please enter mobile',
            'contact_email.required'     => 'Please enter contact email',
        ]);


        $project = new Project();
            $project->user_id                   =  Auth::user()->id;
            //$project->project_address_id        =  $addressid;
            $project->forename                  =  $request['forename'];
            $project->surname                   =  $request['surname'];
            $project->project_name              =  $request['project_name'];
            $project->description               =  $request['description'];
            $project->contact_mobile_no         =  $request['contact_mobile_no'];
            $project->contact_home_phone        =  $request['contact_home_phone'];
            $project->contact_email             =  $request['contact_email'];
            $project->Status                    =  'submitted_for_review';
        $project->save();

        if($request->addresstype == 1){ // Enter your postcode
            $address = new Projectaddresses();
                $address->project_id        = $project->id;
                $address->address_line_one  = $request['zipcode_selected_address_line_one'];
                $address->address_line_two  = $request['zipcode_selected_address_line_two'];
                $address->town_city         = $request['zipcode_selected_town_city'];
                $address->postcode          = $request['zipcode_selected_postcode'];
            $address->save();
        }else{
            $address = new Projectaddresses();
                $address->project_id        = $project->id;
                $address->address_line_one  = $request['address_line_one'];
                $address->address_line_two  = $request['address_line_two'];
                $address->town_city         = $request['town_city'];
                $address->postcode          = $request['postcode'];
            $address->save();
        }

        $sessionmedia = Tempmedia::where('user_id',Auth::user()->id)->get();
        if($sessionmedia){
            foreach($sessionmedia as $row){
                $pfile = new Projectfile();
                    $pfile->project_id          = $project->id;
                    $pfile->file_type           = $row->file_type;
                    $pfile->file_original_name  = $row->file_original_name;
                    $pfile->filename            = $row->filename;
                    $pfile->file_extension      = $row->file_extension;
                    $pfile->url                 = $row->url;
                    $pfile->url                 = $row->url;
                $pfile->save();

                Tempmedia::where('id',$row->id)->delete();
            }
        }

        return redirect()->back()->with('message', 'Project added successfully.');
    }

    function getcustomermediafiles(){
        $getcustomerfiles = Tempmedia::where('file_created_date',date('Y-m-d'))->where('user_id',Auth::user()->id)->get();
        if($getcustomerfiles){
            $html = '';
            foreach($getcustomerfiles as $row){
                $html .= '<div class="d-inline mr-3">'.$row->filename.'<a onclick="deletetempmediafile('.$row->id.')"><img src="'.asset('frontend/img/crose-btn.svg').'" alt="" /> </a></div>';
            }
            echo $html;
        }
    }

    function deletecustomermediafiles(Request $request){

        $filename = Tempmedia::where('id',$request->deleteid)->first()->filename;
        Tempmedia::where('id',$request->deleteid)->delete();
        Storage::disk('s3')->delete('Testfolder/'. $filename);
    }

    function details(Request $request){
        $id=Hashids_decode($request->id);
        $projects = Project::where('id',$id)->first();

        try{
            if(Auth::user()->id == $projects->user_id){
                $projectaddress = Projectaddresses::where('id', Auth::user()->id)->first();
                $doc= projectfile::where('project_id', $id)->get();


                return view('customer/project_details',compact('projects','projectaddress','doc'));
            }else{
                return redirect('/customer/projects');
            }
        } catch (\Exception $e){
            return redirect('/customer/projects');
        }

    }


    function update_name(Request $request) {
        if($request->ajax()){
            $this->validate($request, [
                'name'                              => ['required', 'string'],
            ],[
                'name.required'                     => 'Name field should not be empty',
            ]);
            try{
                $user = User::find(Auth::user()->id);
                $user->name = $request->name;
                $user->update();

                Auth::setUser($user);
            } catch(\Exception $e){
                return response()->json(['errors'=>['name' => ['Failed to update name!']]], $e->getCode());
            }

            return response()->json(['name'=>auth()->user()->name]);
        }

        abort(403);
    }


    function change_password(Request $request){
            $this->validate($request, [
                'new_password'                      => ['required', 'string', 'confirmed', 'max:32', Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
                'new_password_confirmation'         => ['required', 'string', 'max:32', Password::min(8)->letters()->mixedCase()->numbers()->symbols()],
                'current_password'                  => ['required', 'string'],
            ],[
                'new_password.required' => 'Please enter your new password',
                'new_password.confirmed' => "Your new password and confirm password fields don't match",
                'new_password_confirmation.required' => 'Please enter your confirm password',
                'password.required' => 'Please enter your password',
            ]);

            try {
                if (Hash::check($request->current_password, auth()->user()->password)) {
                    $user = auth()->user()->id;
                    User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
                } else {
                    return response()->json(['error'=>'Invalid current password credentials'], 400);
                }
            } catch(\Exception $e) {
                return response()->json(['error'=>'Failed to update password!'], 500);
            }

            return response()->json(['success'=>'Password changed successfully.']);
    }

    function update_phone(Request $request){
        if($request->ajax()){
            $this->validate($request, [
                'phone' => ['required', 'string', 'max:14', 'min:12']
            ]);

            try{
                $user = User::find(Auth::user()->id);
                $user->phone = $request->phone;
                $user->update();

                Auth::setUser($user);
            }catch(\Exception $e){
                return response()->json(['error'=>'Failed to update phone!'], 500);
            }
            return response()->json(['success'=>'Updated Phone Successfully', 'phone'=>Auth::user()->phone]);
        }
        abort(403);
    }

    function update_avatar(Request $request){
        try{
            $user = Auth::user();
            $oldImage = explode('/',$user->profile_image);
            $oldImage = end($oldImage);
            $image = $request->file('file');
            $imageName = $request->file('file')->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $imageName = \Str::of($imageName)->basename('.'.$extension).'_'.Auth::user()->id.'.'.$image->getClientOriginalExtension();
            $path = Storage::disk('s3')->put('Testfolder/'.$imageName,file_get_contents($image->getRealPath(),'public'));
            $path = Storage::disk('s3')->url('Testfolder/'.$imageName);
            $user = Auth::user();
            $user->profile_image = $path;
            $user->update();
            Storage::disk('s3')->delete('Testfolder/'. $oldImage);
            Auth::setUser($user);
            return response()->json(['image_link'=>$user->profile_image]);
        } catch(\Exception $e) {
            return response()->json(['error' => 'Failed to fetch data'],500);
        }
    }

}
