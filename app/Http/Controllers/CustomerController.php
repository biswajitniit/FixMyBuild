<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projectaddresses;
use App\Models\Project;
use App\Models\User;
use App\Models\Projectfile;
use App\Models\{Estimate, Task, TraderDetail, TradespersonFile};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\ProjectReview;

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
        return view("customer.profile");
    }
    public function customer_project(Request $request){
        $project = Project::where('user_id',Auth::user()->id)
                            ->whereIn('status', ['awaiting_your_review', 'submitted_for_review','project_started','estimation','returned_for_review'])
                            ->get();
        $projecthistory = Project::where('user_id',Auth::user()->id)
                                ->whereIn('status', ['project_cancelled', 'project_completed','project_paused'])
                                ->get();
        return view("customer.project",compact('project','projecthistory'));
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
        $getcustomerfiles = Tempmedia::where('sessionid',Session::getId())->get();

        if($getcustomerfiles){
            // $html = '';
            // $video_html = '<div><h4>Videos</h4>';
            // $doc_html   = '<div><h4>Files</h4>';
            // $image_html = '<div><h4>Images</h4>';
            $video_html = '';
            $doc_html   = '';
            $image_html = '';

            foreach($getcustomerfiles as $row){
                // $html .= '<div class="d-inline mr-3">'.$row->filename.'<a onclick="deletetempmediafile('.$row->id.')"><img src="'.asset('frontend/img/crose-btn.svg').'" alt="" /> </a></div>';
                if (strtolower($row->file_type) == 'video'){
                //   $html .= '<div class="col-md-3 mt-2"><video controls="" src="'.$row->url.'"></video>'.'<a onclick="deletetempmediafile('.$row->id.')"><img src="'.asset('frontend/img/crose-btn.svg').'" alt="" /> </a></div>';
                $video_html .= '<div class="d-inline mr-5" id="project-'.$row->id.'">
                            <a href="javascript:void(0)" class="mb-3" onclick="confirmDeletePopup('.$row->id.',\'#project-'.$row->id.'\')">
                            <video src="'.$row->url.'" class="rectangle-video-lg"></video>
                            <div class="remove_img h-95" title="'.$row->filename.'">
                                      <svg class="center-svg" width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                         <path d="M3.28033 0.54L11.0003 8.26L18.6803 0.58C18.85 0.399435 19.0543 0.254989 19.2812 0.155324C19.508 0.0556597 19.7526 0.00282869 20.0003 0C20.5308 0 21.0395 0.210714 21.4145 0.585786C21.7896 0.960859 22.0003 1.46957 22.0003 2C22.005 2.2452 21.9595 2.48877 21.8666 2.71576C21.7738 2.94275 21.6355 3.14837 21.4603 3.32L13.6803 11L21.4603 18.78C21.79 19.1025 21.9832 19.5392 22.0003 20C22.0003 20.5304 21.7896 21.0391 21.4145 21.4142C21.0395 21.7893 20.5308 22 20.0003 22C19.7454 22.0106 19.4911 21.968 19.2536 21.8751C19.016 21.7821 18.8003 21.6408 18.6203 21.46L11.0003 13.74L3.30033 21.44C3.13134 21.6145 2.92945 21.7539 2.70633 21.85C2.4832 21.9461 2.24325 21.9971 2.00033 22C1.46989 22 0.961185 21.7893 0.586112 21.4142C0.211039 21.0391 0.000325413 20.5304 0.000325413 20C-0.00433758 19.7548 0.0411562 19.5112 0.134015 19.2842C0.226874 19.0572 0.36514 18.8516 0.540325 18.68L8.32032 11L0.540325 3.22C0.210695 2.89752 0.0174046 2.46082 0.000325413 2C0.000325413 1.46957 0.211039 0.960859 0.586112 0.585786C0.961185 0.210714 1.46989 0 2.00033 0C2.48033 0.006 2.94033 0.2 3.28033 0.54Z" fill="white" />
                                      </svg>
                                   </div>
                                   </a>
                            </div>';
                } elseif (strtolower($row->file_type) == 'image') {
                //   $html .= '<div class="col-md-3 mt-2"><img src="'.$row->url.'" alt="" class="rectangle-img mr-2"/>'.'<a onclick="deletetempmediafile('.$row->id.')"><img src="'.asset('frontend/img/crose-btn.svg').'" alt="" /> </a></div>';
                    $image_html .= '<div class="d-inline mr-5" id="project-'.$row->id.'">
                                        <a href="javascript:void(0)" class="mb-3" onclick="confirmDeletePopup('.$row->id.',\'#project-'.$row->id.'\')">
                                            <img src="'.$row->url.'" alt="" class="rectangle-img-lg center-svg">
                                            <div class="remove_img h-100" title="'.$row->filename.'">
                                                <svg class="center-svg" width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M3.28033 0.54L11.0003 8.26L18.6803 0.58C18.85 0.399435 19.0543 0.254989 19.2812 0.155324C19.508 0.0556597 19.7526 0.00282869 20.0003 0C20.5308 0 21.0395 0.210714 21.4145 0.585786C21.7896 0.960859 22.0003 1.46957 22.0003 2C22.005 2.2452 21.9595 2.48877 21.8666 2.71576C21.7738 2.94275 21.6355 3.14837 21.4603 3.32L13.6803 11L21.4603 18.78C21.79 19.1025 21.9832 19.5392 22.0003 20C22.0003 20.5304 21.7896 21.0391 21.4145 21.4142C21.0395 21.7893 20.5308 22 20.0003 22C19.7454 22.0106 19.4911 21.968 19.2536 21.8751C19.016 21.7821 18.8003 21.6408 18.6203 21.46L11.0003 13.74L3.30033 21.44C3.13134 21.6145 2.92945 21.7539 2.70633 21.85C2.4832 21.9461 2.24325 21.9971 2.00033 22C1.46989 22 0.961185 21.7893 0.586112 21.4142C0.211039 21.0391 0.000325413 20.5304 0.000325413 20C-0.00433758 19.7548 0.0411562 19.5112 0.134015 19.2842C0.226874 19.0572 0.36514 18.8516 0.540325 18.68L8.32032 11L0.540325 3.22C0.210695 2.89752 0.0174046 2.46082 0.000325413 2C0.000325413 1.46957 0.211039 0.960859 0.586112 0.585786C0.961185 0.210714 1.46989 0 2.00033 0C2.48033 0.006 2.94033 0.2 3.28033 0.54Z" fill="white" />
                                                </svg>
                                            </div>
                                        </a>
                                    </div>';
                } else {
                    $doc_html .= '<div class="d-inline mr-5" id="project-'.$row->id.'">
                                    <a href="javascript:void(0)" class="mb-3" onclick="confirmDeletePopup('.$row->id.',\'#project-'.$row->id.'\')">
                                        <img src="'.asset('frontend/img/file_logo.png').'" alt="'. $row->filename.'" title="'.$row->filename.'" class="rectangle-img-lg center-svg" >
                                        <div class="remove_img h-100" title="'.$row->filename.'">
                                            <svg class="center-svg" width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M3.28033 0.54L11.0003 8.26L18.6803 0.58C18.85 0.399435 19.0543 0.254989 19.2812 0.155324C19.508 0.0556597 19.7526 0.00282869 20.0003 0C20.5308 0 21.0395 0.210714 21.4145 0.585786C21.7896 0.960859 22.0003 1.46957 22.0003 2C22.005 2.2452 21.9595 2.48877 21.8666 2.71576C21.7738 2.94275 21.6355 3.14837 21.4603 3.32L13.6803 11L21.4603 18.78C21.79 19.1025 21.9832 19.5392 22.0003 20C22.0003 20.5304 21.7896 21.0391 21.4145 21.4142C21.0395 21.7893 20.5308 22 20.0003 22C19.7454 22.0106 19.4911 21.968 19.2536 21.8751C19.016 21.7821 18.8003 21.6408 18.6203 21.46L11.0003 13.74L3.30033 21.44C3.13134 21.6145 2.92945 21.7539 2.70633 21.85C2.4832 21.9461 2.24325 21.9971 2.00033 22C1.46989 22 0.961185 21.7893 0.586112 21.4142C0.211039 21.0391 0.000325413 20.5304 0.000325413 20C-0.00433758 19.7548 0.0411562 19.5112 0.134015 19.2842C0.226874 19.0572 0.36514 18.8516 0.540325 18.68L8.32032 11L0.540325 3.22C0.210695 2.89752 0.0174046 2.46082 0.000325413 2C0.000325413 1.46957 0.211039 0.960859 0.586112 0.585786C0.961185 0.210714 1.46989 0 2.00033 0C2.48033 0.006 2.94033 0.2 3.28033 0.54Z" fill="white" />
                                            </svg>
                                        </div>
                                    </a>
                                </div>';
                }
            }

            if ($video_html != '')
                $video_html = '<div><h4>Video(s)</h4>'.$video_html.'</div>';
            if ($doc_html != '')
                $doc_html = '<div><h4>File(s)</h4>'.$doc_html.'</div>';
            if ($image_html != '')
                $image_html = '<div><h4>Image(s)</h4>'.$image_html.'</div>';

            echo $image_html.$video_html.$doc_html;
        }
    }


    function getprojectmediafiles(Request $request){
        $getcustomerfiles = Projectfile::where('project_id',Hashids_decode($request->projectid))->get();
        if($getcustomerfiles){
            $html = '';
            foreach($getcustomerfiles as $row){
                $html .= '<div class="d-inline mr-3">'.$row->filename.'<a onclick="deletetempmediafile('.$row->id.')"> ('. getRemoteFileSize($row->url) .') <img src="'.asset('frontend/img/crose-btn.svg').'" alt="" /> </a></div>';
            }
            echo $html;
        }
    }

    function deletecustomermediafiles(Request $request){
        $filename = Tempmedia::where('id',$request->deleteid)->first()->filename;
        Tempmedia::where('id',$request->deleteid)->delete();
        Storage::disk('s3')->delete('Testfolder/'. $filename);
    }


    public function project_return_for_review(Request $request, $id){
        $project = Project::where('id',Hashids_decode($id))->first();
        $projectaddresses = Projectaddresses::where('project_id',Hashids_decode($id))->first();
        $projectfile = Projectfile::where('project_id',Hashids_decode($id))->first();
        return view("customer/project-returned-for-review",compact('project','projectaddresses','projectfile'));
    }

    public function customer_editproject(Request $request, $projectid){

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

        $data = array(
            'forename'                 => $request['forename'],
            'surname'                  => $request['surname'],
            'project_name'             => $request['project_name'],
            'description'              => $request['description'],
            'contact_mobile_no'        => $request['contact_mobile_no'],
            'contact_home_phone'       => $request['contact_home_phone'],
            'contact_email'            => $request['contact_email'],
            'status'                   => 'submitted_for_review',
            'reviewer_status'          => ''
        );
        Project::where('id', Hashids_decode($projectid))->update($data);


        if($request->addresstype == 1){ // Enter your postcode
            $datapostcode = array(
                'address_line_one'      => $request['zipcode_selected_address_line_one'],
                'address_line_two'      => $request['zipcode_selected_address_line_two'],
                'town_city'             => $request['zipcode_selected_town_city'],
                'postcode'              => $request['zipcode_selected_postcode']
            );
            Projectaddresses::where('id', Hashids_decode($projectid))->update($datapostcode);

        }elseif($request->addresstype == 2){ // type your address
            $datapostcode = array(
                'address_line_one'      => $request['address_line_one'],
                'address_line_two'      => $request['address_line_two'],
                'town_city'             => $request['town_city'],
                'postcode'              => $request['postcode']
            );
            Projectaddresses::where('id', Hashids_decode($projectid))->update($datapostcode);
        }



        return redirect()->back()->with('message', 'Project return for review send successfully.');
    }



    public function details($project_id){

        $id=Hashids_decode($project_id);
        // DB::enableQueryLog();
        $projects = Project::where('id',$id)->first();
        // dd(DB::getQueryLog());
        try{
            if(Auth::user()->id == $projects->user_id){
                $projectaddress = Projectaddresses::where('id', Auth::user()->id)->first();
                $doc= projectfile::where('project_id', $id)->get();
                $project_id=$id;;

                if($projects->status == 'submitted_for_review'){
                    $doc= projectfile::where('project_id', $id)->get();
                    return view('customer.project_details',compact('projects','doc'));
                }

                if($projects->status == 'project_started'){
                    $estimate = Estimate::where('project_id', $id)->first();
                    $tasks = Task::where('estimate_id', $estimate->id)->get();
                    $trader_detail = TraderDetail::where('user_id', $estimate->tradesperson_id)->first();
                    $project_reviews = ProjectReview::where('project_id', $estimate->project_id)->get();
                    $company_logo = TradespersonFile::where(['tradesperson_id'=> $estimate->tradesperson_id , 'file_related_to' => 'company_logo'])->first();
                    $teams_photos = TradespersonFile::where(['tradesperson_id'=> $estimate->tradesperson_id , 'file_related_to' => 'team_img'])->get();
                    $prev_project_imgs = TradespersonFile::where(['tradesperson_id'=> $estimate->tradesperson_id , 'file_related_to' => 'prev_project_img'])->get();

                    $amount = 0;
                    foreach ($tasks as $task) {
                        $price = $task->price;
                        $amount += $task->price;
                    }
                    $taskTotalAmount = ($amount != 0)? (($estimate->apply_vat == 0)? $amount : ($amount + (env('VAT_CHARGE') * $amount) / 100)) : 0;
                    $taskAmountWithContingency = (($taskTotalAmount * $estimate->contingency)/100) + $taskTotalAmount;
                    $taskAmountWithContingencyAndVat = (($taskAmountWithContingency * 20)/100) + $taskAmountWithContingency;
                    $initial_payment_percentage = $estimate->initial_payment;
                    $contingency_per_task = ($price * $estimate->contingency)/100;

                    if($estimate->apply_vat == 1){
                        if($estimate->initial_payment_type == 'Percentage'){
                            $initial_payment_percentage = ($taskAmountWithContingencyAndVat * $estimate->initial_payment)/100;
                        }
                    } elseif($estimate->apply_vat == 0){
                        $initial_payment_percentage = ($taskAmountWithContingency * $estimate->initial_payment)/100;
                    }
                    // for showing amounts in 2 decimal
                    $taskTotalAmount = round($taskTotalAmount, 2);
                    $taskAmountWithContingency = round($taskAmountWithContingency, 2);
                    $taskAmountWithContingencyAndVat = round($taskAmountWithContingencyAndVat, 2);
                    $initial_payment_percentage = number_format($initial_payment_percentage, 2);
                    $contingency_per_task = number_format($contingency_per_task, 2);
                    return view('customer.project_details',compact('projects','estimate','tasks', 'doc','trader_detail','prev_project_imgs','teams_photos','company_logo','taskTotalAmount','taskAmountWithContingency','taskAmountWithContingencyAndVat','initial_payment_percentage','contingency_per_task','project_reviews'));
                }

                if($projects->status == 'estimation') {
                    $estimates = Estimate::where('project_id', $projects->id)->with(['tasks', 'tradesperson'])->get();

                    foreach($estimates as $estimate) {
                        $amount = $estimate->tasks->sum('price');
                        $estimate->price = ($amount != 0) ? (($estimate->apply_vat == 0) ? $amount : ($amount + (env('VAT_CHARGE') * $amount) / 100)) : 0;

                        // $query = ProjectReview::where('tradesperson_id', $estimate->tradesperson->id);
                        // $reviewCount = $query->count();

                        // $estimate->totalRatings = $reviewCount;
                        // $estimate->workmanshipPercentage = $reviewCount ? (($query->sum('workmanship') / (2 * $reviewCount)) * 100) : null;
                        // $estimate->punctualityPercentage = $reviewCount ? ( $query->sum('punctuality') / $reviewCount) * 100 : null;
                        // $estimate->tidinessPercentage = $reviewCount ? ( $query->sum('tidiness') / $reviewCount) * 100 : null;
                        // $estimate->priceAccuracy = $reviewCount ? (  $query->sum('price_accuracy') / $reviewCount) * 100 : null;

                        $query = ProjectReview::where('tradesperson_id', $estimate->tradesperson->id);
                        $estimate->totalRatings = $query->count();

                        if($estimate->totalRatings) {
                            $reviewCount = $estimate->totalRatings;
                            $estimate->workmanshipPercentage = ($query->sum('workmanship') / (2 * $reviewCount)) * 100;
                            $estimate->punctualityPercentage = ($query->sum('punctuality') / $reviewCount) * 100;
                            $estimate->tidinessPercentage    = ($query->sum('tidiness') / $reviewCount) * 100;
                            $estimate->priceAccuracy         = ($query->sum('price_accuracy') / $reviewCount) * 100;
                        }
                    };

                    return view('customer.project_details',compact('projects','projectaddress','doc','project_id','estimates'));
                }

                return view('customer.project_details',compact('projects','projectaddress','doc','project_id'));
            } else{
                // return redirect('/customer/projects');
                return redirect()->route('customer.project');
            }
        } catch (\Exception $e){
            // return redirect('/customer/projects');
            return redirect()->route('customer.project');
        }

    }

    public function cancel_project(Request $request){
        try {
            Project::where('id', $request->project_id)->update(['status' => $request->status]);
            return response()->json(['redirect_url' => route('customer.project')]);
        } catch (Exception $e) {
            echo 'error';
        }
    }

    function review(Request $request){
        return view("customer/project_review");
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
            // $imageName = \Str::of($imageName)->basename('.'.$extension).'_'.Auth::user()->id.'.'.$image->getClientOriginalExtension();
            // $path = Storage::disk('s3')->put('Testfolder/'.$imageName,file_get_contents($image->getRealPath(),'public'));
            // $path = Storage::disk('s3')->url('Testfolder/'.$imageName);
            $s3FileName = \Str::uuid().'.'.$extension;
            Storage::disk('s3')->put('Testfolder/'.$s3FileName, file_get_contents($image->getRealPath()));
            $path = Storage::disk('s3')->url('Testfolder/'.$s3FileName);
            $user = Auth::user();
            $user->profile_image = $path;
            $user->update();
            Storage::disk('s3')->delete('Testfolder/'. $oldImage);
            Auth::setUser($user);
            return response()->json(['image_link'=>$user->profile_image]);
        } catch(\Exception $e) {
            return response()->json(['error' => 'Failed to update data'],500);
        }
    }
    //z5doyvrmpjnyvn2gmwb6e8dk29x53jplqaz97row89lb3gqea6
    public function project_review($project_id)
    {
        try{
            return view("customer.review", ['project_id' => $project_id]);
        } catch(\Exception $e) {
            return 'error';
        }

    }

    // public function submit_review(Request $request)
    // {
    //     $request->validate([
    //         'optradio1' => 'required',
    //         'optradio2' => 'required',
    //         'optradio3' => 'required',
    //         'optradio4' => 'required',
    //         'optradio5' => 'required',
    //     ]);
    //     try {
    //         $project_id = Hashids_decode($request->project_id);
    //         //dd($p_id);die;
    //         // $review = ProjectReview::where('user_id','=', Auth::user()->id)
    //         //     ->where('project_id', '=', $project_id)
    //         //     ->get();
    //         $tradeperson = Estimate::where('project_id', $project_id[0])
    //             ->where('project_awarded', 1)
    //             ->where('status', 'awarded')
    //             ->value('tradesperson_id');
    //         //if (count($review)==0) {
    //             $review = new ProjectReview();
    //             $review->user_id = Auth::user()->id;
    //             $review->tradesperson_id = $tradeperson;
    //             $review->project_id = $project_id[0];
    //             $review->punctuality = $request->optradio1;
    //             $review->workmanship = $request->optradio2;
    //             $review->tidiness = $request->optradio3;
    //             $review->price_accuracy = $request->optradio4;
    //             $review->detailed_review = $request->optradio5;
    //             $review->description = $request->detailed_review;
    //             $review->save();
    //             return 'Saved';
    //         // } else {
    //         //     $review = DB::table('project_reviews')
    //         //     ->where('user_id', '=', Auth::user()->id,)
    //         //     ->where('project_id','=', $project_id)
    //         //     ->where('tradesperson_id','=', $tradeperson)
    //         //     ->update([
    //         //         'punctuality' => $request->optradio1,
    //         //         'workmanship' => $request->optradio2,
    //         //         'tidiness' => $request->optradio3,
    //         //         'price_accuracy' => $request->optradio4,
    //         //         'detailed_review' => $request->optradio5,
    //         //         'description' => $request->detailed_review
    //         //     ]);
    //         //     return 'Review Updated';
    //         // }

    //     } catch(\Exception $e) {
    //         echo $e;
    //     }
    // }

    public function project_estimate(Request $request, $id)
    {
        $id = Hashids_decode($id);
        $estimate = Estimate::where('id', $id)
                            ->first();
        $project = Project::where('id', $estimate->project_id)->first();
        // $projectid = Projectfile::where('project_id', $estimate->project_id)->get();
        $trader_detail = TraderDetail::where('user_id', $estimate->tradesperson_id)->first();
        $user = User::where('id', $trader_detail->user_id)->first();
        $project_reviews = ProjectReview::where('project_id', $estimate->project_id)->get();
        $company_logo = TradespersonFile::where(['tradesperson_id'=> $estimate->tradesperson_id , 'file_related_to' => 'company_logo'])->first();
        $teams_photos = TradespersonFile::where(['tradesperson_id'=> $estimate->tradesperson_id , 'file_related_to' => 'team_img'])->get();
        $prev_project_imgs = TradespersonFile::where(['tradesperson_id'=> $estimate->tradesperson_id , 'file_related_to' => 'prev_project_img'])->get();


        $tasks = Task::where('estimate_id', $estimate->id)->get();
        $amount = 0;
            foreach ($tasks as $task) {
                $price = $task->price;
                $amount += $task->price;
            }
        $taskTotalAmount = ($amount != 0)? (($estimate->apply_vat == 0)? $amount : ($amount + (env('VAT_CHARGE') * $amount) / 100)) : 0;
        $taskAmountWithContingency = (($taskTotalAmount * $estimate->contingency)/100) + $taskTotalAmount;
        $taskAmountWithContingencyAndVat = (($taskAmountWithContingency * 20)/100) + $taskAmountWithContingency;
        $initial_payment_percentage = $estimate->initial_payment;
        $contingency_per_task = ($price * $estimate->contingency)/100;

        if($estimate->apply_vat == 1){
            if($estimate->initial_payment_type == 'Percentage'){
                $initial_payment_percentage = ($taskAmountWithContingencyAndVat * $estimate->initial_payment)/100;
            }
        } elseif($estimate->apply_vat == 0){
            $initial_payment_percentage = ($taskAmountWithContingency * $estimate->initial_payment)/100;
        }
        // for showing amounts in 2 decimal
        $taskTotalAmount = round($taskTotalAmount, 2);
        $taskAmountWithContingency = round($taskAmountWithContingency, 2);
        $taskAmountWithContingencyAndVat = round($taskAmountWithContingencyAndVat, 2);
        $initial_payment_percentage = number_format($initial_payment_percentage, 2);
        $contingency_per_task = number_format($contingency_per_task, 2);

        return view('customer.estimate_details',compact('project','trader_detail','company_logo','teams_photos','prev_project_imgs','project_reviews','user','estimate','tasks','taskTotalAmount','taskAmountWithContingency','taskAmountWithContingencyAndVat','initial_payment_percentage','contingency_per_task'));

    }
}
