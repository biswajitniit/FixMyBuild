<?php

namespace App\Http\Controllers\Tradepersion;

use App\Http\Controllers\Controller;
use App\Http\Resources\EstimateProjectResource;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use App\Models\{
  Buildercategory,
  AreaCover,
  SubAreaCover,
  TraderDetail,
  Traderareas,
  Traderworks,
  User,
  Notification,
  tempmedia,
  TradespersonFile,
  Project,
  Projectfile,
  Estimate,
  Task,
  ProjectEstimateFile,
  CountyTown
};
use Illuminate\Support\Facades\{
    Http,
    Validator,
    Storage
};
use Auth;
use Redirect;
use stdClass;
use DB;



class TradepersionDashboardController extends Controller
{
    public function registrationsteptwo()
    {
        $works = Buildercategory::where('status', 'Active')->get();
        $areas = AreaCover::where('status', 1)->get();

        // If the Form Validation Fails then load the files from temp_media
        $temp_company_logo = Tempmedia::where(['user_id' => Auth::user()->id, 'sessionid' => session()->getId(), 'file_related_to' => 'company_logo'])->first();
        $temp_public_liability_insurances = Tempmedia::where(['user_id' => Auth::user()->id, 'sessionid' => session()->getId(), 'file_related_to' => 'public_liability_insurance'])->get();
        $temp_comp_addresses = Tempmedia::where(['user_id' => Auth::user()->id, 'sessionid' => session()->getId(), 'file_related_to' => 'company_address'])->get();
        $temp_trader_images = Tempmedia::where(['user_id' => Auth::user()->id, 'sessionid' => session()->getId(), 'file_related_to' => 'trader_img'])->get();
        $temp_team_imgs = Tempmedia::where(['user_id' => Auth::user()->id, 'sessionid' => session()->getId(), 'file_related_to' => 'team_img'])->get();
        $temp_prev_projs = Tempmedia::where(['user_id' => Auth::user()->id, 'sessionid' => session()->getId(), 'file_related_to' => 'prev_project_img'])->get();
        $counties = CountyTown::distinct('county')->pluck('county');
        $areas = DB::table('county_towns')
                    ->select('*')
                    ->orderBy('county')
                    ->get()
                    ->groupBy('county')
                    ->map(function ($group) {
                        // return $group->pluck('town')->sortDesc()->toArray();
                        return $group->pluck('town')->sortBy(function ($town) {
                            return ($town === '' || $town === null) ? PHP_INT_MAX : $town;
                        })->toArray();
                    })
                    ->toArray();



        // dd($areas);
        // $counties = UkTown::distinct()->pluck('county');

        // return view('tradepersion.registrationtwo', compact('works', 'areas', 'counties', 'temp_company_logo', 'temp_public_liability_insurances', 'temp_comp_addresses', 'temp_trader_images', 'temp_team_imgs', 'temp_prev_projs'));

        return view('tradepersion.registrationtwo', compact('works', 'areas', 'temp_company_logo', 'temp_public_liability_insurances', 'temp_comp_addresses', 'temp_trader_images', 'temp_team_imgs', 'temp_prev_projs'));
    }

    public function saveregistrationsteptwo(Request $request){
        // $this->validate($request, [
		// 	'comp_reg_no'       => 'required',
		// 	'comp_name'         => 'required',
		// 	'trader_name'       => 'required',
		// 	'comp_description'  => 'required',
		// 	'name'              => 'required',
        //     'phone_code'        => 'required',
        //     'phone_number'      => 'required',
        //     'email'             => 'required',
        //     'designation'       => 'required',
        //     'vat_reg'           => 'required',
        //     'subworktype'       => 'required',
        //     'subareacovers'     => 'required',

        // ],[
        //     'comp_reg_no.required'      => 'Please enter company registration number and validate',
        //     'comp_name.required'        => 'Please enter company registration number and validate',
        //     'trader_name.required'      => 'Please enter your trader name',
        //     'comp_description.required' => 'Please enter your company descriptions',
        //     'name.required'             => 'Please enter your name',
        //     'phone_code.required'       => 'Please select your phone code',
        //     'phone_number.required'     => 'Please enter your phone number',
        //     'email.required'            => 'Please enter your email',
        //     'designation.required'      => 'Please enter your designation',
        //     'vat_reg.required'          => 'Please enter your vat number and validate',
        //     'subworktype.required'      => 'Please select work you do',
        //     'subareacovers.required'    => 'Please select area do you cover',
        // ]);

        $rules = [
            'comp_reg_no'       => 'required|unique:'.TraderDetail::class,
            'comp_name'         => 'required',
            'trader_name'       => 'required',
            'comp_description'  => 'required',
            'name'              => 'required',
            'phone_code'        => 'required',
            'phone_number'      => 'required',
            'email'             => 'required',
            'company_role'      => 'required',
            'vat_reg'           => 'required',
            'subworktype'       => 'required',
            'subareacovers'     => 'required',
        ];

        if ($request->has('designation')) {
            $rules['designation'] = 'required|string|max:255';
        }

        if($request->vat_reg) {
            $rules['vat_no'] = 'required|string|max:255';
        }

        $messages = [
            'comp_reg_no.required'      => 'Please enter company registration number and validate',
            'comp_reg_no.unique'        => 'Company with this registration number has already been registered',
            'comp_name.required'        => 'Please enter company registration number and validate',
            'trader_name.required'      => 'Please enter your trader name',
            'comp_description.required' => 'Please enter your company descriptions',
            'company_role.required'     => 'Please select your role in company',
            'name.required'             => 'Please enter your name',
            'phone_code.required'       => 'Please select your phone code',
            'phone_number.required'     => 'Please enter your phone number',
            'email.required'            => 'Please enter your email',
            'designation.required'      => 'Please enter your designation',
            'designation.max'           => 'Designation shouldn\'t be longer than 255 characters',
            'vat_reg.required'          => 'Please enter your vat number and validate',
            'subworktype.required'      => 'Please select work you do',
            'subareacovers.required'    => 'Please select area do you cover',
        ];

        $errors = new MessageBag();
        if ( $request->phone_office_with_dial_code ) {
            $phone_office_with_dial_code = str_replace('-', '', str_replace(' ', '', substr($request->phone_office_with_dial_code,1,-1)));
            if ( !is_numeric($phone_office_with_dial_code) )
                $errors->add('phone_office', 'Please provide a valid office phone number');
        }

        if ( $request->phone_number ) {
            $phone_number = str_replace('-', '', str_replace(' ', '', $request->phone_number));
            if( !is_numeric($phone_number) )
                $errors->add('phone_number', 'Please provide a valid phone number');
        }

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails() || count($errors) != 0) {
            $errors->merge($validator->errors());
            return redirect(route('tradepersion.compregistration'))
                        ->withInput()
                        ->withErrors($errors);
        }

        // $validatedData = $this->validate($request, $rules, $messages);
        if (TraderDetail::where('user_id', Auth::user()->id)->first() != null) {
            $errors = new MessageBag(['submiterror' => ['You have already registered a company in our platform.']]);
		    return Redirect::back()->withErrors($errors)->withInput();
        }

        $traderdetails = new TraderDetail();
        $traderdetails->user_id = Auth::user()->id;
        $traderdetails->comp_reg_no = $request->comp_reg_no;
        $traderdetails->txt_comp_name = $request->txt_comp_name;
        $traderdetails->comp_name = $request->comp_name;
        $traderdetails->comp_address = $request->comp_address;
        $traderdetails->trader_name = $request->trader_name;
        $traderdetails->comp_description = $request->comp_description;
        $traderdetails->name = $request->name;
        $traderdetails->phone_code = $request->phone_code;
        $traderdetails->phone_number = $request->phone_number;
        $traderdetails->phone_office = $request->phone_office_with_dial_code;
        $traderdetails->email = $request->email;
        $traderdetails->company_role = $request->company_role;
        $traderdetails->designation = $request->designation;
        $traderdetails->vat_reg = $request->vat_reg;
        $traderdetails->vat_no = $request->vat_no;
        $traderdetails->vat_comp_name = $request->vat_comp_name;
        $traderdetails->vat_comp_address = $request->vat_comp_address;
        if($traderdetails->save()){
            $user = Auth::user()->id;
            $session = session()->getId();
            $single_file_uploads = ['company_logo'];

            $temp_medias = Tempmedia::where(['user_id'=>$user, 'sessionid'=>$session])->get();
            $old_files = [];
            foreach($temp_medias as $temp_media){
                if(in_array($temp_media->file_related_to, $single_file_uploads)){
                    $old_files = TradespersonFile::where(['tradesperson_id'=>$user, 'file_related_to'=>$temp_media->file_related_to])->get();
                }

                TradespersonFile::create([
                    'tradesperson_id' => $temp_media->user_id,
                    'file_related_to' => $temp_media->file_related_to,
                    'file_type' => $temp_media->file_type,
                    'file_name' => $temp_media->filename,
                    'file_extension' => $temp_media->file_extension,
                    'url' => $temp_media->url,
                ]);

                foreach($old_files as $old_file){
                    // Delete Old File
                    TradespersonFile::where('id', $old_file->id)->delete();
                }

            }

            // Delete the temporary media files
            Tempmedia::where(['user_id'=>$user, 'sessionid'=>$session])->delete();

            // Change Customer Profile with Company Logo
            $profile_img = TradespersonFile::where(['tradesperson_id' => Auth::user()->id, 'file_related_to' => 'company_logo'])->first();
            if($profile_img) {
                $user = Auth::user();
                $user->profile_image = $profile_img->url;
                $user->save();
            }

            if($request->subworktype){
                $subworktype = array_unique($request->subworktype);
                // Get Old Subwork Types
                $oldSubWorkTypes = Traderworks::where('user_id', Auth::user()->id)->get();
                foreach($subworktype as $w){
                    $traderwork = new Traderworks();
                    $traderwork->user_id = Auth::user()->id;
                    $traderwork->buildersubcategory_id = $w;
                    $traderwork->save();
                }
                // Delete old subcategories
                foreach ($oldSubWorkTypes as $oldSubWorkType) {
                    Traderworks::where('id', $oldSubWorkType->id)->delete();
                }
            }

            if($request->subareacovers){
                // Get Old Area Covers
                $oldAreaCovers = Traderareas::where('user_id', Auth::user()->id)->get();
                // foreach($subareacovers as $a){
                    // $a = json_decode($a);
                // foreach($towns as $town) {
                //     $traderarea = new Traderareas();
                //     $traderarea->user_id = Auth::user()->id;
                //     $traderarea->sub_area_cover_id = $town->id;
                //     $traderarea->county = $town->area->area_type;
                //     $traderarea->town = $town->sub_area_type;
                //     $traderarea->save();
                // }

                $subareacovers = array_unique($request->subareacovers);
                foreach($subareacovers as $area) {
                    $traderarea = new Traderareas();
                    $traderarea->user_id = Auth::id();
                    [$traderarea->county, $traderarea->town] = explode('|',$area);
                    $traderarea->save();
                }

                // Delete old areas
                foreach ($oldAreaCovers as $oldAreaCover) {
                    Traderareas::where('id', $oldAreaCover->id)->delete();
                }
            }
            $userstatus = User::where('id', Auth::user()->id)->update(['steps_completed' => "2"]);

            // return redirect()->intended('/tradeperson/bank-registration');
            return redirect()->intended(route('tradepersion.bankregistration'));
        }else{
            $errors = new MessageBag(['submiterror' => ['Something went wrong please try again.']]);
		    return Redirect::back()->withErrors($errors)->withInput();
        }
    }

    public function registrationstepthree()
    {
        $notification = Notification::where('user_id', Auth::user()->id)->first()->settings;
        return view('tradepersion.registrationthree', compact('notification'));
    }

    public function saveregistrationstepthree(Request $request){
        $this->validate($request, [
			'contingency'           => 'required',
			'bnk_account_type'      => 'required',
			'bnk_account_name'      => 'required',
			'bnk_sort_code'         => 'required',
			'bnk_account_number'    => 'required',
        ],[
            'contingency.required'      => 'Please enter contingency',
            'bnk_account_type.required' => 'Please select your bank account type',
            'bnk_account_name.required' => 'Please enter your account holder name',
            'bnk_sort_code.required'    => 'Please enter your bank sort code',
            'bnk_account_number.required'   => 'Please enter your bank account number',
        ]);
        $traderdetails = TraderDetail::where('user_id', Auth::user()->id)->first();
        $traderdetails->contingency = $request->contingency;
        $traderdetails->bnk_account_type = $request->bnk_account_type;
        $traderdetails->bnk_account_name = $request->bnk_account_name;
        $traderdetails->bnk_sort_code = $request->bnk_sort_code;
        $traderdetails->bnk_account_number = $request->bnk_account_number;
        $traderdetails->builder_amendment = $request->builder_amendment ?? 0;
        // $traderdetails->email_notification = json_encode([
        //     "noti_new_quotes"           => $request->noti_new_quotes ?? "0",
        //     "noti_quote_accepted"       => $request->noti_quote_accepted ?? "0",
        //     "noti_project_stopped"      => $request->noti_project_stopped ?? "0",
        //     "noti_quote_rejected"       => $request->noti_quote_rejected ?? "0",
        //     "noti_project_cancelled"    => $request->noti_project_cancelled ?? "0",
        //     "noti_share_contact_info"   => $request->noti_share_contact_info ?? "0",
        //     'noti_new_message'          => "1",
        // ]);

        if($traderdetails->save()){
            // $notification = new stdClass();
            // $notification->builder_amendment = $request->builder_amendment ? $request->builder_amendment : 0;
            // $notification->noti_new_quotes = $request->noti_new_quotes ? $request->noti_new_quotes : 0;
            // $notification->noti_quote_accepted = $request->noti_quote_accepted ? $request->noti_quote_accepted : 0;
            // $notification->noti_project_stopped = $request->noti_project_stopped ? $request->noti_project_stopped : 0;
            // $notification->noti_quote_rejected = $request->noti_quote_rejected ? $request->noti_quote_rejected : 0;
            // $notification->noti_project_cancelled = $request->noti_project_cancelled ? $request->noti_project_cancelled : 0;
            // $notijson = json_encode($notification);
            $notification = [
                // Receive these notifications as a Tradesperson
                'builder_amendment'         => $request->builder_amendment ?? "0",
                'noti_new_quotes'           => $request->noti_new_quotes ?? "0",
                'noti_quote_accepted'       => $request->noti_quote_accepted ?? "0",
                'noti_project_stopped'      => $request->noti_project_stopped ?? "0",
                'noti_quote_rejected'       => $request->noti_quote_rejected ?? "0",
                'noti_project_cancelled'    => $request->noti_project_cancelled ?? "0",
                'noti_share_contact_info'   => config('const.trader_notification_share_contact_info'),
                'noti_new_message'          => config('const.trader_notification_trader_new_message'),

                // Receive these notifications as a Customer
                'reviewed'                  => config('const.trader_notification_reviewed'),
                'paused'                    => config('const.trader_notification_paused'),
                'project_milestone_complete'=> config('const.trader_notification_project_milestone_complete'),
                'project_complete'          => config('const.trader_notification_project_complete'),
                'project_new_message'       => config('const.trader_notification_project_new_message'),
            ];
            Notification::where('user_id',Auth::user()->id)->update(['settings' => $notification]);

            // $notify = new Notification();
            // $notify->user_id = Auth::user()->id;
            // $notify->settings = $notijson;
            // $notify->settings = $notification;
            // $notify->save();
            $userstatus = User::where('id', Auth::user()->id)->update(['steps_completed' => "3"]);
            return Redirect::back()->with('status', 'success');
        }else{
            $errors = new MessageBag(['submiterror' => ['Something went wrong please try again.']]);
            return Redirect::back()->withErrors($errors)->withInput();
        }

    }

    function get_companydetails(Request $request){
        $key= "1d5582f8-d62b-459f-9264-2e7a998d97b9";
        $secret = "";
        $company_id = $request->company_id;
        $response = Http::withBasicAuth($key,$secret)->get('https://api.company-information.service.gov.uk/company/'.$company_id);
        if ($response->failed()) {
           return $response;
        } else {
           return $response;
        }
    }
    public function get_company_vat_details(Request $request)
    {
        $key= "";
        $secret = "";
        $vat_number = $request->vat_number;
        $response = Http::withBasicAuth($key,$secret)->get('https://api.service.hmrc.gov.uk/organisations/vat/check-vat-number/lookup/'.$vat_number);
        if ($response->failed()) {
           return $response;
        } else {
           return $response;
        }
    }

    function getTempTeamImages(Request $request)
    {
        $temp_team_imgs = Tempmedia::where(['user_id' => Auth::user()->id, 'sessionid' => session()->getId(), 'file_related_to' => 'team_img'])->get();
        echo $this->getTempMedia($temp_team_imgs);
    }

    function getTempPrevProjImages(Request $request)
    {
        $temp_prev_projects = Tempmedia::where(['user_id' => Auth::user()->id, 'sessionid' => session()->getId(), 'file_related_to' => 'prev_project_img'])->get();
        echo $this->getTempMedia($temp_prev_projects);
    }

    function getTempPublicLiabilityInsurance(Request $request)
    {
        $temp_public_liability_insurances = Tempmedia::where(['user_id' => Auth::user()->id, 'sessionid' => session()->getId(), 'file_related_to' => 'public_liability_insurance'])->get();
        echo $this->getTempMedia($temp_public_liability_insurances);
    }

    function getTempPhotoIdProof(Request $request)
    {
        $temp_trader_images = Tempmedia::where(['user_id' => Auth::user()->id, 'sessionid' => session()->getId(), 'file_related_to' => 'trader_img'])->get();
        echo $this->getTempMedia($temp_trader_images);
    }

    function getTempCompAddrProof(Request $request)
    {
        $temp_comp_addresses = Tempmedia::where(['user_id' => Auth::user()->id, 'sessionid' => session()->getId(), 'file_related_to' => 'company_address'])->get();
        echo $this->getTempMedia($temp_comp_addresses);
    }

    function getProductImage(Request $request)
    {
        $temp_project_images = Tempmedia::where(['user_id' => Auth::user()->id, 'sessionid' => session()->getId(), 'media_type' => 'estimate'])->get();
        echo $this->getTempMedia($temp_project_images);
    }

    private function getTempMedia($files) {
        $html = '';
        foreach ($files as $file) {
            $ext = explode('.', $file->url);
            $ext = end($ext);
            $image_ext = ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp', 'heic', 'heif'];
            $video_ext = ['avi', 'mp4', 'm4v', 'ogv', '3gp', '3g2'];
            $thumbnailMapping = [
                'pdf'       => asset('frontend/img/pdf_logo.svg'),
                'doc'       => asset('frontend/img/doc_logo.svg'),
                'others'    => asset('frontend/img/file_logo.svg'),
            ];

            $html .= '<div class="d-inline mr-2 mt-1" id="Image-0'.$file->id.'">
                        <a href="javascript:void(0)" class="mb-1" onclick="confirmDeletePopup('.$file->id.', \'Image-0'.$file->id.'\')">';
            if(in_array(strtolower($ext), $image_ext))
                $html .= '<img src="'.$file->url .'" alt="" class="rectangle-img">';
            elseif(strtolower($ext) == 'pdf')
                $html .= '<img src="'.$thumbnailMapping['pdf'].'" alt="" class="rectangle-img">';
            elseif(in_array(strtolower($ext), ['doc', 'docx', 'odt']))
                $html .= '<img src="'.$thumbnailMapping['doc'].'" alt="" class="rectangle-img">';
            else
                $html .= '<img src="'.$thumbnailMapping['others'] .'" alt="" class="rectangle-img">';
            $html .= '<div class="remove_img" title="'.$file->filename.'">
                        <svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.28033 0.54L11.0003 8.26L18.6803 0.58C18.85 0.399435 19.0543 0.254989 19.2812 0.155324C19.508 0.0556597 19.7526 0.00282869 20.0003 0C20.5308 0 21.0395 0.210714 21.4145 0.585786C21.7896 0.960859 22.0003 1.46957 22.0003 2C22.005 2.2452 21.9595 2.48877 21.8666 2.71576C21.7738 2.94275 21.6355 3.14837 21.4603 3.32L13.6803 11L21.4603 18.78C21.79 19.1025 21.9832 19.5392 22.0003 20C22.0003 20.5304 21.7896 21.0391 21.4145 21.4142C21.0395 21.7893 20.5308 22 20.0003 22C19.7454 22.0106 19.4911 21.968 19.2536 21.8751C19.016 21.7821 18.8003 21.6408 18.6203 21.46L11.0003 13.74L3.30033 21.44C3.13134 21.6145 2.92945 21.7539 2.70633 21.85C2.4832 21.9461 2.24325 21.9971 2.00033 22C1.46989 22 0.961185 21.7893 0.586112 21.4142C0.211039 21.0391 0.000325413 20.5304 0.000325413 20C-0.00433758 19.7548 0.0411562 19.5112 0.134015 19.2842C0.226874 19.0572 0.36514 18.8516 0.540325 18.68L8.32032 11L0.540325 3.22C0.210695 2.89752 0.0174046 2.46082 0.000325413 2C0.000325413 1.46957 0.211039 0.960859 0.586112 0.585786C0.961185 0.210714 1.46989 0 2.00033 0C2.48033 0.006 2.94033 0.2 3.28033 0.54Z" fill="white" />
                        </svg>
                    </div>
                </a>
            </div>';
        }
        return $html;
    }

    public function dashboard()
    {
        $works = Buildercategory::where('status', 'Active')->get();
        $areas = DB::table('county_towns')
                    ->select('*')
                    ->orderBy('county')
                    ->get()
                    ->groupBy('county')
                    ->map(function ($group) {
                        return $group->pluck('town')->sortBy(function ($town) {
                            return ($town === '' || $town === null) ? PHP_INT_MAX : $town;
                        })->toArray();
                    })
                    ->toArray();
        $trader_details = TraderDetail::where('user_id', Auth::user()->id)->first();
        $company_logo = TradespersonFile::where(['tradesperson_id' => Auth::user()->id, 'file_related_to' => 'company_logo'])->first();
        $public_liability_insurances = TradespersonFile::where(['tradesperson_id' => Auth::user()->id, 'file_related_to' => 'public_liability_insurance'])->get();
        $team_images = TradespersonFile::where(['tradesperson_id' => Auth::user()->id, 'file_related_to' => 'team_img'])->get();
        $prev_project_images = TradespersonFile::where(['tradesperson_id' => Auth::user()->id, 'file_related_to' => 'prev_project_img'])->get();
        $trader_work = Traderworks::with('buildersubcategory')->where('user_id', Auth::user()->id)->get();
        $trader_areas = Traderareas::where('user_id', Auth::user()->id)->get();
        // dd($trader_area->toArray());
        return view('tradepersion.dashboard', compact('works', 'areas', 'trader_details', 'trader_work', 'trader_areas', 'company_logo', 'public_liability_insurances', 'team_images', 'prev_project_images'));
    }
    function storeTempTraderFile(Request $request)
    {

        try{
            $user = Auth::user()->id;

            // $this->validate($request, [
            //     'file_related_to' => 'required|string',
            // ]);

            $files = $request->file('file');
            $response = [];

            // if (!is_array($files)) {
            //     $file = $files;
            //     $fileName = $file->getClientOriginalName();
            //     $extension = $file->getClientOriginalExtension();
            //     $s3FileName = \Str::uuid().'.'.$extension;
            //     Storage::disk('s3')->put('Testfolder/'.$s3FileName, file_get_contents($file->getRealPath()));
            //     $path = Storage::disk('s3')->url('Testfolder/'.$s3FileName);

            //     $single_file_uploads = ['company_logo'];

            //     if( in_array($request->file_related_to, $single_file_uploads)){
            //         $delete_medias_after_save = tempmedia::where(['file_related_to'=> $request->file_related_to, 'media_type'=> 'tradesperson', 'user_id' => $user])->get();
            //     }

            //     $fileType = '';
            //     if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'gif' || $extension == 'svg' || $extension == 'webp' || $extension == 'heic' || $extension == 'heif')
            //         $fileType = 'image';
            //     else
            //         $fileType = 'document';

            //     $temp_media = new Tempmedia();
            //     $temp_media->user_id           = $user;
            //     $temp_media->sessionid         = session()->getId();
            //     $temp_media->file_type         = $fileType;
            //     $temp_media->media_type        = 'tradesperson';
            //     $temp_media->file_related_to   = $request->file_related_to;
            //     $temp_media->filename          = $fileName;
            //     $temp_media->file_extension    = $extension;
            //     $temp_media->url               = $path;
            //     $temp_media->file_created_date = now()->toDateString();
            //     $temp_media->save();

            //     if (isset($delete_medias_after_save) && !empty($delete_medias_after_save)) {
            //         $delete_medias_after_save->each(function ($media) {
            //             $media->delete();
            //         });
            //     }

            //     return response()->json(['image_link' => $path, 'file_name' => $fileName]);
            // }

            foreach($files as $file) {
                // $fileName = $request->file('file')->getClientOriginalName();
                $fileName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $s3FileName = \Str::uuid().'.'.$extension;
                Storage::disk('s3')->put('Testfolder/'.$s3FileName, file_get_contents($file->getRealPath()));
                $path = Storage::disk('s3')->url('Testfolder/'.$s3FileName);

                $single_file_uploads = ['company_logo'];

                if( in_array($request->file_related_to, $single_file_uploads)){
                    $delete_medias_after_save = tempmedia::where(['file_related_to'=> $request->file_related_to, 'media_type'=> 'tradesperson', 'user_id' => $user])->get();
                }

                $fileType  = '';
                $image_ext = ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp', 'heic', 'heif'];
                $video_ext = ['avi', 'mp4', 'm4v', 'ogv', '3gp', '3g2'];
                if ( in_array($extension, $image_ext) )
                    $fileType = 'image';
                elseif ( in_array($extension, $video_ext) )
                    $fileType = 'video';
                else
                    $fileType = 'document';

                $temp_media = new Tempmedia();
                $temp_media->user_id           = $user;
                $temp_media->sessionid         = session()->getId();
                $temp_media->file_type         = $fileType;
                $temp_media->media_type        = $request->media_type ?? 'tradesperson';
                $temp_media->file_related_to   = $request->file_related_to;
                $temp_media->filename          = $fileName;
                $temp_media->file_extension    = $extension;
                $temp_media->url               = $path;
                $temp_media->file_created_date = now()->toDateString();
                $temp_media->save();

                $uploaded_file = ['image_link' => $path, 'file_name' => $fileName];
                array_push($response, $uploaded_file);

                if (isset($delete_medias_after_save) && !empty($delete_medias_after_save)) {
                    $delete_medias_after_save->each(function ($media) {
                        $media->delete();
                    });
                }
            }

            return response()->json($response);
            // return response()->json(['image_link'=>$path, 'file_name'=>$fileName]);
        } catch(\Exception $e) {
            return response()->json(['error' => 'Failed to store data'],500);
        }
    }
    function updateTraderName(Request $request)
    {
        $traderdetails = TraderDetail::where('user_id', Auth::user()->id)->first();
        $traderdetails->trader_name = $request->tradername;
        if($traderdetails->save()){
            $data = array(
                'status' => 1,
                'message' => "Trading name has been successfully updated"
            );
        }else{
            $data = array(
                'status' => 0,
                'message' => "Oops! Something went wrong. Please try again"
            );
        }
        return $data;
    }
    public function updateTraderDesc(Request $request)
    {
        $traderdetails = TraderDetail::where('user_id', Auth::user()->id)->first();
        $traderdetails->comp_description = $request->traderdesc;
        if($traderdetails->save()){
            $data = array(
                'status' => 1,
                // 'message' => "Description has been successfully updated"
                'description' => TraderDetail::where('user_id', Auth::user()->id)->first()->comp_description,
            );
        }else{
            $data = array(
                'status' => 0,
                'message' => "Oops! Something went wrong. Please try again"
            );
        }
        return $data;
    }
    public function updateTraderContactInfo(Request $request)
    {
        $traderdetails = TraderDetail::where('user_id', Auth::user()->id)->first();
        $traderdetails->name = $request->contactName;
        $traderdetails->phone_number = $request->contactMobile;
        $traderdetails->phone_code = $request->countryCode;
        $traderdetails->phone_office = $request->contactOfficeMobile;
        $traderdetails->email = $request->contactEmail;
        if($traderdetails->save()){
            $data = array(
                'status'        => 1,
                'contact_name'  => $traderdetails->name,
                'email'         => $traderdetails->email,
                'phone'         => $traderdetails->phone_number,
                'phone_code'    => $traderdetails->phone_code,
                'office_phone'  => $traderdetails->phone_office,
            );
        }else{
            $data = array(
                'status' => 0,
                'message' => "Oops! Something went wrong. Please try again"
            );
        }
        return $data;
    }
    public function updateVatInfo(Request $request)
    {
        $traderdetails = TraderDetail::where('user_id', Auth::user()->id)->first();
        $traderdetails->vat_no = $request->vatno;
        if($traderdetails->save()){
            $data = array(
                'status' => 1,
                'message' => "Vat Number has been successfully updated"
            );
        }else{
            $data = array(
                'status' => 0,
                'message' => "Oops! Something went wrong. Please try again"
            );
        }
        return $data;
    }
    public function updateContingency(Request $request)
    {
        $traderdetails = TraderDetail::where('user_id', Auth::user()->id)->first();
        $traderdetails->contingency = $request->contigencyval;
        if($traderdetails->save()){
            $data = array(
                'status' => 1,
                'message' => "Contingency has been successfully updated"
            );
        }else{
            $data = array(
                'status' => 0,
                'message' => "Oops! Something went wrong. Please try again"
            );
        }
        return $data;
    }
    public function updateAccount(Request $request)
    {
        $traderdetails = TraderDetail::where('user_id', Auth::user()->id)->first();
        $traderdetails->bnk_account_type = $request->accountType;
        $traderdetails->bnk_account_name = $request->accountHolder;
        $traderdetails->bnk_sort_code = $request->accountCode;
        $traderdetails->bnk_account_number = $request->accountNum;
        if($traderdetails->save()){
            $data = array(
                'status' => 1,
                'message' => "Account Information has been successfully updated"
            );
        }else{
            $data = array(
                'status' => 0,
                'message' => "Oops! Something went wrong. Please try again"
            );
        }
        return $data;
    }
    public function updateWorkType(Request $request)
    {
        $list = $request->worktype;
        $deletetrader = Traderworks::where('user_id', Auth::user()->id)->delete();
        foreach($list as $w){
            $traderwork = new Traderworks();
            $traderwork->user_id = Auth::user()->id;
            $traderwork->buildersubcategory_id = $w;
            $traderwork->save();
        }

        $updated_data = Traderworks::where('user_id', Auth::user()->id)
                                ->with('buildersubcategory')
                                ->get();
        $builderSubcategoryName = [];

        foreach ($updated_data as $item) {
            array_push($builderSubcategoryName, $item->buildersubcategory->builder_subcategory_name);
        }

        $data = array(
            'status' => 1,
            'works' => $builderSubcategoryName,
        );
        return $data;
    }

    public function updateCompanyLogo(Request $request)
    {
        try{
            $image      = $request->file('file');
            $fileName   = $request->file('file')->getClientOriginalName();
            $extension  = $image->getClientOriginalExtension();
            $s3FileName = \Str::of($fileName)->basename('.'.$extension).'_'.now()->format('Y_m_d_H_i_s').'_'.rand(1000,9999).'.'.$image->getClientOriginalExtension();
            $path       = Storage::disk('s3')->put('Testfolder/'.$s3FileName,file_get_contents($image->getRealPath(),'public'));
            $path       = Storage::disk('s3')->url('Testfolder/'.$s3FileName);
            $oldLogos   = TradespersonFile::where(['tradesperson_id' => Auth::user()->id, 'file_related_to' => 'company_logo'])->get();

            $companyLogo = new TradespersonFile();
            $companyLogo->tradesperson_id   = Auth::user()->id;
            $companyLogo->file_related_to   = 'company_logo';
            $companyLogo->file_type         = 'image';
            $companyLogo->file_name         = $fileName;
            $companyLogo->file_extension    = $extension;
            $companyLogo->url               = $path;
            if($companyLogo->save()){
                // Delete Old Logo
                foreach($oldLogos as $oldLogo) {
                    $oldLogo->delete();
                }
                // TradespersonFile::where('id',$oldLogo->id)->delete();
                // Set Company Logo As User's Profile Image
                $user = Auth::user();
                $user->profile_image = $path;
                $user->save();
            }

            return response()->json(['image_link'=>$path]);
        } catch(\Exception $e) {
            return response()->json(['error' => 'Failed to update data'],500);
        }
    }

    public function updateTraderArea(Request $request)
    {
        $subareacovers = array_unique($request->areatype);
        $oldAreaCovers = Traderareas::where('user_id', Auth::user()->id)->get();

        foreach($subareacovers as $area) {
            $traderarea = new Traderareas();
            $traderarea->user_id = Auth::id();
            [$traderarea->county, $traderarea->town] = explode('|',$area);
            $traderarea->save();
        }

        // Delete old areas
        foreach ($oldAreaCovers as $oldAreaCover) {
            Traderareas::where('id', $oldAreaCover->id)->delete();
        }

        $data = array(
            'status' => 1,
            'areas' => array_map(function ($area) {
                            $area = explode('|', $area);
                            return \Str::title($area[1]) . ', ' . \str::title($area[0]);
                        }, $subareacovers),
        );
        return $data;
    }

    public function deleteTraderFile(Request $request)
    {
        if(TradespersonFile::where('id', $request->file)->delete()){
            return response()->json([
                'response' => 'success',
            ]);
        }
        return response()->json([
            'response' => 'fail',
        ]);
    }

    public function storeTraderFile(Request $request)
    {
        try{
            $user = Auth::user();

            $this->validate($request, [
                'file_related_to' => 'required|string',
                'file_type' =>'nullable',
            ]);

            $files = $request->file('file');
            $response = [];

            foreach($files as $file){

                $fileName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $s3FileName = \Str::uuid().'.'.$extension;
                Storage::disk('s3')->put('Testfolder/'.$s3FileName,file_get_contents($file->getRealPath()));
                $path = Storage::disk('s3')->url('Testfolder/'.$s3FileName);
                $single_file_uploads = ['company_logo'];

                if( in_array($request->file_related_to, $single_file_uploads)){
                    $delete_medias_after_save = TradespersonFile::where(['file_related_to'=> $request->file_related_to, 'tradesperson_id' =>  $user->id])->get();
                }

                $fileType  = '';
                $image_ext = ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp', 'heic', 'heif'];
                $video_ext = ['avi', 'mp4', 'm4v', 'ogv', '3gp', '3g2'];

                if ( in_array($extension, $image_ext) )
                    $fileType = 'image';
                elseif ( in_array($extension, $video_ext) )
                    $fileType = 'video';
                else
                    $fileType = 'document';

                $tradesperson_file = TradespersonFile::create([
                    'tradesperson_id' => Auth::user()->id,
                    'file_related_to' => $request->file_related_to,
                    'file_type'       => $fileType,
                    'file_name'       => $fileName,
                    'file_extension'  => $extension,
                    'url'             => $path,
                ]);

                // Set Company Logo As User's Profile Image
                if($request->file_related_to == 'company_logo') {
                    $user = Auth::user();
                    $user->profile_image = $path;
                    $user->save();
                }

                // $uploaded_file = ['file' => $tradesperson_file];
                // array_push($response, $uploaded_file);
                array_push($response, $tradesperson_file);

                if (isset($delete_medias_after_save) && !empty($delete_medias_after_save)) {
                    $delete_medias_after_save->each(function ($media) {
                        $media->delete();
                    });
                }
            }

            return $response;
            // return response()->json(['file' => $tradesperson_file]);
        } catch(\Exception $e) {
            return response()->json(['error' => 'Failed to store data'],500);
        }
    }

    public function projects(Request $request)
    {
        // Fetch Trader Areas And Works
        $trader_areas = Traderareas::where(['user_id' => Auth::user()->id])->get();
        $trader_works = Traderworks::where('user_id', Auth::user()->id)->get();
        $estimate_projects = recommended_projects($trader_areas, $trader_works)
                             ->orWhere(function ($query) {
                                 $query->where(function($q) {
                                         $q->whereIn('id', Estimate::where('tradesperson_id', Auth::user()->id)->pluck('project_id')->toArray())
                                             ->where('reviewer_status', 'approved')
                                             ->whereNotIn('status', ['project_cancelled', 'project_paused', 'project_completed', 'awaiting_your_review']);
                                     })
                                     ->orWhere(function ($q) {
                                         $q->where('reviewer_status', 'approved')
                                             ->whereIn('projects.id', Estimate::where(['tradesperson_id'=> Auth::user()->id, 'project_awarded'=> 1, 'status'=>'awarded'])
                                             ->pluck('project_id')
                                             ->toArray()
                                         );
                                     });
                             })
                             ->orderBy('projects.created_at', 'desc')
                             ->get();



        $estimate_project_histories = Project::where(function ($query) {
                                                $query->whereIn('status', ['project_cancelled', 'project_paused', 'project_completed', 'awaiting_your_review'])
                                                        ->whereIn('id', Estimate::where('tradesperson_id', Auth::user()->id)
                                                            ->pluck('project_id')
                                                            ->toArray()
                                                        );
                                            })
                                            ->orWhere(function($query) {
                                                $query->where('status','project_started')
                                                      ->whereIn('id', Estimate::where('tradesperson_id', Auth::user()->id)
                                                                                ->where('project_awarded', 0)
                                                                                ->pluck('project_id')
                                                                                ->toArray()
                                                        );
                                            })
                                            ->orderBy('created_at', 'desc')
                                            ->get();

        // Tradesperson as a customer
        $project = Project::where('user_id', Auth::id())
                            ->whereIn('status', ['awaiting_your_review', 'submitted_for_review','project_started','estimation','returned_for_review'])
                            ->get();
        $projecthistory = Project::where('user_id', Auth::id())
                                    ->whereIn('status', ['project_cancelled', 'project_completed','project_paused'])
                                    ->get();

        return view('tradepersion.projects', compact('estimate_projects', 'estimate_project_histories', 'project', 'projecthistory'));
    }

    public function searchProject(Request $request)
    {
        $trader_works = Traderworks::where('user_id', Auth::user()->id)->get();
        $trader_areas = Traderareas::where(['user_id' => Auth::user()->id])->get();

        $estimate_projects = Project::where( function($query) use($trader_works, $trader_areas, $request) {
                                            // $query->where('reviewer_status', 'approved')
                                            //         ->distinct('projects.id')
                                            //         ->whereHas('subCategories', function($query) use($trader_works) {
                                            //             $query->whereIn('buildersubcategories.id', \Arr::pluck($trader_works, 'buildersubcategory_id'));
                                            //         })
                                            //         ->whereDoesntHave('estimates', function ($query) {
                                            //             $query->where('project_awarded', 1);
                                            //         })
                                            //         ->where('projects.user_id', '<>', Auth::user()->id)
                                            //         ->when(($request->has('keyword') && !empty($request->keyword)), function ($q) use ($request) {
                                            //             $q->where('projects.project_name', 'like', '%' . $request->keyword . '%');
                                            //         })
                                            //         ->select('projects.*');
                                            // $query->where(function ($q) use ($trader_areas) {
                                            //             foreach ($trader_areas as $trader_area) {
                                            //                 $q->orWhere(function ($subQuery) use ($trader_area) {
                                            //                     $subQuery->where('town', $trader_area->town)
                                            //                     ->where('county', $trader_area->county);
                                            //                 });
                                            //             }
                                            //         });
                                            recommended_projects($trader_areas, $trader_works)
                                            ->when(($request->has('keyword') && !empty($request->keyword)), function ($q) use ($request) {
                                                $q->where('projects.project_name', 'like', '%' . $request->keyword . '%');
                                            });
                                        }) // Recommends new projects | status: Write Estimate
                                      ->orWhere(function ($query) use($request) {
                                          $query->where(function($q) use($request) {
                                                  $q->when(($request->has('keyword') && !empty($request->keyword)), function ($sql) use ($request) {
                                                    $sql->where('projects.project_name', 'like', '%' . $request->keyword . '%');
                                                  })->whereIn('id', Estimate::where('tradesperson_id', Auth::user()->id)->pluck('project_id')->toArray())
                                                    ->whereNotIn('status', ['project_cancelled', 'project_paused', 'project_completed', 'awaiting_your_review'])
                                                    ->where('reviewer_status', 'approved');
                                              })
                                              ->orWhere(function ($q) use($request){
                                                  $q->when(($request->has('keyword') && !empty($request->keyword)), function ($sql) use ($request) {
                                                        $sql->where('projects.project_name', 'like', '%' . $request->keyword . '%');
                                                    })
                                                    ->whereIn('projects.id', Estimate::where(['tradesperson_id'=> Auth::user()->id, 'project_awarded'=> 1, 'status'=>'awarded'])
                                                        ->pluck('project_id')
                                                        ->toArray()
                                                    )
                                                    ->where('reviewer_status', 'approved');
                                              });
                                        }) // Estimates already submitted by the user | Estimates Other Than Write Estimate
                                      ->orderBy('projects.created_at', 'desc')
                                      ->get();

        return view('tradepersion.project_lists.new_project_list', compact('estimate_projects'))->render();
    }

    public function searchProjectHistory(Request $request)
    {
        $estimate_project_histories = Project::when(($request->has('keyword') && !empty($request->keyword)), function ($query) use ($request) {
                                                    $query->where('project_name', 'like', '%' . $request->keyword . '%');
                                                })
                                                ->where(function($sql) {
                                                    $sql->where(function ($query) {
                                                        $query->whereIn('status', ['project_cancelled', 'project_paused', 'project_completed', 'awaiting_your_review'])
                                                                ->whereIn('id', Estimate::where('tradesperson_id', Auth::user()->id)
                                                                    ->pluck('project_id')
                                                                    ->toArray()
                                                                );
                                                    })
                                                    ->orWhere(function($query) {
                                                        $query->where('status','project_started')
                                                              ->whereIn('id', Estimate::where('tradesperson_id', Auth::user()->id)
                                                                                        ->where('project_awarded', 0)
                                                                                        ->pluck('project_id')
                                                                                        ->toArray()
                                                                        );
                                                    });
                                                })
                                                ->orderBy('created_at', 'desc')
                                                ->get();
        return view('tradepersion.project_lists.project_history_list', compact('estimate_project_histories'))->render();
    }

    public function paginateProject(Request $request)
    {
        if($request->ajax())
        {
            $estimate_projects = Estimate::where('tradesperson_id', Auth::user()->id)
            ->join('projects', 'estimates.project_id', '=', 'projects.id')
            ->when(($request->has('keyword') && !empty($request->keyword)), function ($query) use ($request) {
                $query->where('projects.project_name', 'like', '%' . $request->keyword . '%');
            })
            ->with('project')
            ->paginate(10);

            $key = 0;
            $html = '';
            foreach ($estimate_projects as $data) {
                $projectStatus = tradesperson_project_status($data->project->id);
                if ($projectStatus == 'write_estimate') {
                    $status = '<span class="text-primary">Write estimate</span>';
                }elseif ($projectStatus == 'estimate_recalled') {
                    $status = '<span class="text-warning">Estimate recalled</span>';
                }elseif ($projectStatus == 'estimate_submitted') {
                    $status = '<span class="text-info">Estimate submitted</span>';
                }elseif ($projectStatus == 'estimate_rejected') {
                    $status = '<span class="text-danger">Estimate rejected</span>';
                }elseif ($projectStatus == 'estimate_not_accepted') {
                    $status = '<span class="text-danger">Estimate not accepted</span>';
                }elseif ($projectStatus == 'estimate_accepted') {
                    $status = '<span class="text-success">Estimate accepted</span>';
                }else{
                    $status = '<span>&nbsp;</span>';
                }

                $key += 1;
                $html .= "<tr><td>" . $key . "</td>" .
                    "<td>" . $data->project->project_name . "</td>" .
                    "<td>" . $data->project->created_at->format('d/m/Y') . "<br>" .
                    "<em>" . $data->project->created_at->format('g:i A') . "</em></td>" .
                    "<td>".$status."</td>" .
                    "<td><a href='#' class='btn btn-view'>View</a></td></tr>";
            }
            return $html;
        }
    }

    // public function paginateProjectHisory(Request $request)
    // {
    //     if(!$request->ajax())
    //         abort(403);
    //     $keyword  = $request->keyword;
    //     $statuses = $request->statuses;
    //     $estimate_project_histories = Project::when(($request->has('keyword') && !empty($request->keyword)), function($query) use ($request) {
    //         $query->where('project_name', 'like', '%' . $request->keyword . '%');
    //     })->when(($request->has('statuses') && !empty($request->statuses)), function($query) use ($request) {
    //         $query->when(in_array("Project completed", $request->statuses), function($q) {
    //                     $q->where('status', 'completed');
    //                 })
    //               ->when(in_array("Project paused", $request->statuses), function($q) {
    //                     $q->where('status', 'paused');
    //                 })
    //               ->when(in_array("Project rejected", $request->statuses), function($q) {
    //                     $q->where(['status'=>'estimation', '']);
    //                 });
    //     });

    //     $estimate_project_histories->paginate(1);
    //     // $estimate_project_histories->where(function ($query) {
    //     //     $query->whereIn('status', ['cancelled', 'paused', 'completed', 'awaiting_your_review'])
    //     //             ->whereIn('id', Estimate::where('tradesperson_id', Auth::user()->id)
    //     //                 ->pluck('project_id')
    //     //                 ->toArray()
    //     //             );
    //     // })
    //     // ->orWhere(function($query) {
    //     //     $query->where('status','project_started')
    //     //           ->whereIn('id', Estimate::where('tradesperson_id', Auth::user()->id)
    //     //                                     ->where('project_awarded', 0)
    //     //                                     ->pluck('project_id')
    //     //                                     ->toArray()
    //     //             );
    //     // })
    //     // ->paginate(1, ['*'], 'project_history');

    //     return view('tradepersion.project_lists.project_history_list', compact('keyword', 'statuses'))->render();
    // }

    public function settings()
    {
        $notification = Notification::where('user_id',Auth::user()->id)->first()->settings;
        return view('tradepersion.settings', compact('notification'));
    }

    public function saveSettings(Request $request)
    {
        if(!$request->ajax())
            abort(403);

        try {
            $notification = [
                // Receive these notifications as a Tradesperson
                'builder_amendment'         => $request->builder_amendment ?? "0",
                'noti_new_quotes'           => $request->noti_new_quotes ?? "0",
                'noti_quote_accepted'       => $request->noti_quote_accepted ?? "0",
                'noti_project_stopped'      => $request->noti_project_stopped ?? "0",
                'noti_quote_rejected'       => $request->noti_quote_rejected ?? "0",
                'noti_project_cancelled'    => $request->noti_project_cancelled ?? "0",
                'noti_share_contact_info'   => $request->noti_share_contact_info ?? "0",
                'noti_new_message'          => "1",

                // Receive these notifications as a Customer
                'reviewed'                  => $request->reviewed ?? "0",
                'paused'                    => $request->paused ?? "0",
                'project_milestone_complete'=> $request->project_milestone_complete ?? "0",
                'project_complete'          => $request->project_complete ?? "0",
                'project_new_message'       => $request->project_new_message ?? "0",
            ];

            Notification::where('user_id', Auth::user()->id)->update(['settings' => $notification]);
            return response()->json(['status' => 'success']);
        } catch(\Exception $e) {
            return response()->json(['status' => 'error']);
        }


    }

    public function project_estimate(Request $request,$key)
    {
        try{
            $default_contingency = TraderDetail::where(['user_id' => Auth::user()->id])->first()->contingency;
            return view("tradepersion.estimate", ['project_id' => $key, 'default_contingency' => $default_contingency]);
        } catch(\Exception $e) {
            return 'error';
        }
    }


    public function projectestimate(Request $request)
    {
        // try {
            // $insert_estimate = new Estimate();
            // $insert_estimate->project_id = $request->project_id;
            // $insert_estimate->tradesperson_id = Auth::user()->id;
            // // echo $request;die;
            // if($request->describe_mode==null){
            //     $insert_estimate->describe_mode = 'Unable_to_describe ';
            //     if($request->Need_more_info!=null){
            //         $insert_estimate->unable_to_describe_type = 'Need_more_info';
            //     }
            //     else if($request->Do_not_undertake_project_type!=null){
            //         $insert_estimate->unable_to_describe_type = 'Do_not_undertake_project_type';
            //     }else{
            //         $insert_estimate->unable_to_describe_type = 'Do_not_cover_location';
            //     }
            //     $insert_estimate->more_info = $request->typeHere;
            //     $insert_estimate->covers_customers_all_needs = 0;
            //     $insert_estimate->payment_required_upfront = 0;
            //     $insert_estimate->contingency = 0;
            //     $insert_estimate->initial_payment = 0;
            //     $insert_estimate->initial_payment_type = null;
            //     $insert_estimate->project_start_date_type = null;
            //     $insert_estimate->project_start_date = null;
            //     $insert_estimate->total_time = '';
            //     $insert_estimate->total_time_type = '';
            //     $insert_estimate->apply_vat = 0;
            //     $insert_estimate->terms_and_conditions = '';
            //     if($insert_estimate->save()){
            //         return Redirect::back()->with('status', 'success');
            //     }else{
            //         return Redirect::back()->with('status', 'error');
            //     }
            // }else{
            // $insert_estimate->describe_mode = $request->describe_mode;
            // }
            // if($request->covers_customers_all_needs == 0){
            //     $insert_estimate->covers_customers_all_needs = 0;
            // }else{
            //     $insert_estimate->covers_customers_all_needs = $request->covers_customers_all_needs;
            // }
            // if($request->payment_required_upfront == 0){
            //     $insert_estimate->payment_required_upfront = 0;
            //     $insert_estimate->initial_payment = 0;
            //     $insert_estimate->initial_payment_type = null;
            // }else{
            //     $insert_estimate->payment_required_upfront = $request->payment_required_upfront;
            //     if($request->initial_payment_percentage!=null){
            //         $insert_estimate->initial_payment = $request->initial_payment_percentage;
            //         $insert_estimate->initial_payment_type = 'Percentage';
            //     }else{
            //         $insert_estimate->initial_payment = $request->initial_payment_amount;
            //         $insert_estimate->initial_payment_type = 'Fixed';
            //     }

            // }
            // if($request->contingency == 0){
            //     $insert_estimate->contingency = 0;
            // }else{
            //     $insert_estimate->contingency = $request->contingency;
            // }
            // $insert_estimate->project_start_date_type = $request->for_start_date;
            // $insert_estimate->project_start_date = $request->project_start_date;
            // $insert_estimate->total_time = $request->total_time;
            // $insert_estimate->total_time_type = $request->total_time_type;

            // if($request->apply_vat==null){
            //     $insert_estimate->apply_vat = 0;
            // }else{
            // $insert_estimate->apply_vat = $request->apply_vat;
            // }
            // $insert_estimate->terms_and_conditions = $request->termsconditions;

            // if($insert_estimate->save())
            // {
            //     echo $insert_estimate;
            //     if($request->describe_mode!=null){
            //         $estimate_id = Estimate::where('tradesperson_id',Auth::user()->id)->where('project_id',$request->project_id)->first();
            //         for($i=1;$i<=$request->total_field;$i++){
            //             $insert_task = new Task();
            //             $insert_task->estimate_id = $estimate_id->id;
            //             $insert_task->description = $request->input('task'."$i");
            //             $insert_task->price = $request->input('amount'."$i");
            //             $insert_task->save();
            //         }
            //     }

            //     return Redirect::back()->with('status', 'success');
            // }else{
            //     return Redirect::back()->with('status', 'error');
            // }

        try{
            $old_estimate = Estimate::where([
                                'project_id'      => $request->project_id,
                                'tradesperson_id' => Auth::user()->id,
                            ])->first();

            if ($old_estimate) {
                $errors = new MessageBag(['duplicate_entry' => 'You have already written an estimate for this project.']);
                return redirect()->back()->withErrors($errors);
            }

            if (\Str::lower($request->describe_mode) == 'unable_to_describe') {

                if (\Str::lower($request->unable_to_describe_type) == 'need_more_info' && !$request->typeHere) {
                    $errors = new MessageBag(['more_info' => ['I need more information field is required']]);
                    return Redirect::back()->withErrors($errors)->withInput();
                }

                Estimate::create([
                    'describe_mode'           => $request->describe_mode,
                    'project_id'              => $request->project_id,
                    'tradesperson_id'         => Auth::user()->id,
                    'unable_to_describe_type' => $request->unable_to_describe_type,
                    'more_info'               => \Str::lower($request->unable_to_describe_type) == 'need_more_info' ? $request->typeHere : null,
                ]);

                return redirect()->route('tradepersion.projects');
            }

            $errors = new MessageBag();
            for($i=1; $i<=$request->total_field; $i++){
                if ( empty($request->input("task"."$i")) )
                    $errors->add("task"."$i", 'Please provide a description for task '.$i.'.');
                if ( empty($request->input("amount"."$i")))
                    $errors->add("amount"."$i", 'Please provide a price for task '.$i.'.');
                if ( !empty($request->input("amount"."$i")) && !is_numeric($request->input("amount"."$i")) )
                    $errors->add("numeric_amount"."$i", 'Please provide a numeric value for task '.$i.' price.');
            }

            $rules = [
                'covers_customers_all_needs' => 'nullable|boolean',
                'payment_required_upfront'   => 'nullable|boolean',
                'apply_vat'                  => 'nullable|boolean',
                'contingency'                => 'required|numeric',
                'for_start_date'             => 'required',
                'total_time'                 => 'required',
                'total_time_type'            => 'required|string',
                'termsconditions'            => 'required|string',
            ];

            if (\Str::lower($request->for_start_date) == 'specific_date')
                $rules['project_start_date'] = 'required|date';

            if ($request->payment_required_upfront && \Str::lower($request->initial_payment_type) == 'percentage')
                $rules['initial_payment_percentage'] = 'required|numeric';
            elseif ($request->payment_required_upfront && \Str::lower($request->initial_payment_type) == 'fixed_amount')
                $rules['initial_payment_amount'] = 'required|numeric';


            $messages = [
                'termsconditions.required'  => 'The terms and condition field is required.'
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails() || count($errors) != 0) {
                $errors->merge($validator->errors());
                return redirect()->back()->withInput()->withErrors($errors);
            }

            $initial_payment = null;

            if ($request->payment_required_upfront && $request->initial_payment_type == 'fixed_amount')
                $initial_payment = $request->initial_payment_amount;
            elseif ($request->payment_required_upfront && $request->initial_payment_type == 'percentage')
                $initial_payment = $request->initial_payment_percentage;

            $estimate = Estimate::create([
                'describe_mode'              => $request->describe_mode,
                'project_id'                 => $request->project_id,
                'tradesperson_id'            => Auth::user()->id,
                'covers_customers_all_needs' => $request->covers_customers_all_needs ?? 0,
                'payment_required_upfront'   => $request->payment_required_upfront ?? 0,
                'apply_vat'                  => $request->apply_vat ?? 0,
                'contingency'                => $request->contingency,
                'initial_payment'            => $initial_payment ,
                'initial_payment_type'       => $request->initial_payment_type ,
                'project_start_date_type'    => $request->for_start_date ,
                'project_start_date'         => ($request->for_start_date == 'specific_date' ) ? $request->project_start_date : null,
                'total_time'                 => $request->total_time ,
                'total_time_type'            => $request->total_time_type ,
                'terms_and_conditions'       => $request->termsconditions ,
            ]);

            if ($estimate) {

                if ($request->payment_required_upfront) {
                    Task::create([
                        'estimate_id' => $estimate->id,
                        'description' => 'initial payment',
                        'price'       => $request->initial_payment_type == 'percentage' ? $request->initial_payment_calculated_percentage : $request->initial_payment_amount,
                        'is_initial'  => true,
                    ]);
                }

                for ($i = 1; $i <= $request->total_field; $i++) {
                    Task::create([
                        'estimate_id'     => $estimate->id,
                        'description'     => $request->input('task'."$i"),
                        'price'           => $request->input('amount'."$i"),
                        'contingency'     => $request->input('amount'."$i") * ( $request->contingency / 100 ),
                        'max_contingency' => $request->input('amount'."$i") * ( $request->contingency / 100 ),
                    ]);
                }

                // Move the estimate files from temp_media to project_estimate_files
                $temp_medias = tempmedia::where(['user_id' => Auth::user()->id, 'sessionid' => session()->getId(), 'media_type' => 'estimate'])->get();
                foreach ($temp_medias as $temp_media) {
                    $estimate_file = ProjectEstimateFile::create([
                        'estimate_id'        => $estimate->id,
                        'file_related_to'    => $temp_media->file_related_to,
                        'file_type'          => $temp_media->file_type,
                        'file_name'          => $temp_media->filename,
                        'file_original_name' => $temp_media->file_original_name,
                        'file_extension'     => $temp_media->file_extension,
                        'url'                => $temp_media->url,
                    ]);

                    if($estimate_file)
                        $temp_media->delete();
                }
            }

            return redirect()->route('tradepersion.projects');

        } catch (\Exception $e) {
            echo $e;die;
        }
    }


    public function details($id)
    {
        $id = Hashids_decode($id);
        $project = Project::where('id', $id)->first();
        $projectid = Projectfile::where('project_id', $id)->get();
        $trader_detail = TraderDetail::where('user_id', Auth::user()->id)->first();

        // Fetch Trader Areas And Works
        $trader_areas = Traderareas::where(['user_id' => Auth::id()])->get();
        $trader_works = Traderworks::where('user_id', Auth::user()->id)->get();

        $other_open_projects = recommended_projects($trader_areas, $trader_works)->limit(5)->get();

        // $recommended_projects = Project::where('reviewer_status', 'approved')
        //                         ->distinct('projects.id')
        //                         // ->whereIn('county', \Arr::pluck($trader_areas, 'county')) // projects that have the same county as the county where trader provides services
        //                         // ->whereIn('town', \Arr::pluck($trader_areas, 'town')) // projects that have the same town as the town where trader provides services
        //                         ->whereHas('subCategories', function($query) use($trader_works) {
        //                             $query->whereIn('buildersubcategories.id', \Arr::pluck($trader_works, 'buildersubcategory_id'));
        //                         }) // projects that have the same category for which the trader provides services
        //                         ->whereDoesntHave('estimates', function ($query) {
        //                             $query->where('project_awarded', 1);
        //                         }) // projects that doesn't have an estimate or the project which have not started yet
        //                         ->where('projects.id', '<>', $id) // Don't recommend the current project as shown in the current page
        //                         ->where('projects.user_id', '<>', Auth::user()->id) // Don't recommend the project which is submitted by the current tradesperson
        //                         ->join('traderareas', function($query) {
        //                             $query->on(
        //                                 DB::raw('CONCAT(projects.county, projects.town)'), '=', DB::raw('CONCAT(traderareas.county, traderareas.town)')
        //                             );
        //                         })
        //                         ->orderBy('projects.created_at', 'desc') // Recommend as per the most recent created project
        //                         ->select('projects.*')
        //                         ->limit(5)
        //                         ->get();
        // $recommended_projects = Project::join('traderareas', function ($join) {
        //                                     $join->on(DB::raw('CONCAT(projects.county, projects.town)'), '=', DB::raw('CONCAT(traderareas.county, traderareas.town)'));
        //                                 })
        //                                 ->where('projects.reviewer_status', 'Approve')
        //                                 ->distinct('projects.id')
        //                                 ->whereHas('subCategories', function ($query) use ($trader_works) {
        //                                     $query->whereIn('buildersubcategories.id', \Arr::pluck($trader_works, 'buildersubcategory_id'));
        //                                 })
        //                                 ->orWhereDoesntHave('estimates', function ($query) {
        //                                     $query->where('project_awarded', 1);
        //                                 })
        //                                 ->where('projects.id', '<>', $id)
        //                                 ->where('projects.user_id', '<>', Auth::user()->id)
        //                                 ->select('projects.*')
        //                                 ->get();

        if(tradesperson_project_status($project->id) == 'estimate_submitted' || tradesperson_project_status($project->id) == 'project_started' || tradesperson_project_status($project->id) == 'estimate_accepted') {
            $estimate = Estimate::where('project_id', $id)
                            ->where('tradesperson_id', Auth::user()->id)
                            ->first();
             //for comany logo
            $company_logo = TradespersonFile::where(['tradesperson_id'=> $estimate->tradesperson_id , 'file_related_to' => 'company_logo'])->first();
            $teams_photos = TradespersonFile::where(['tradesperson_id'=> $estimate->tradesperson_id , 'file_related_to' => 'team_img'])->get();
            $prev_project_imgs = TradespersonFile::where(['tradesperson_id'=> $estimate->tradesperson_id , 'file_related_to' => 'prev_project_img'])->get();

            // $task_initial = Task::where('estimate_id', $estimate->id)->where('is_initial', 1)->first();
            $tasks = Task::where('estimate_id', $estimate->id)->get();
            $amount = 0;
            $price = 0;
                foreach ($tasks as $task) {
                    $price = $task->price;
                    $amount += $task->price;
                }
            $taskTotalAmount = $amount;
            $taskAmountWithContingency = (($taskTotalAmount * $estimate->contingency)/100) + $taskTotalAmount;
            $taskAmountWithContingencyAndVat = (($taskAmountWithContingency * config('const.vat_charge'))/100) + $taskAmountWithContingency;
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
            return view('tradepersion.project_details',compact('projectid','project','trader_detail','other_open_projects','estimate','tasks','taskTotalAmount','taskAmountWithContingency','taskAmountWithContingencyAndVat','initial_payment_percentage','contingency_per_task', 'recommended_projects','prev_project_imgs','teams_photos','company_logo'));
        }

        return view('tradepersion.project_details',compact('projectid','project','trader_detail','other_open_projects'));
    }


    public function update_milestone_price(Request $request)
    {
        try {
            DB::table('tasks')
            ->where('id', $request->input('taskId'))
            ->update([
                'contingency' => $request->input('contingency'),
                'status' => $request->input('checkbox')
            ]);

            return response()->json(['contingency' => $request->input('contingency')]);
        } catch (\Exception $e){
            echo "error"; die;
        }

    }

    public function update_task_status(Request $request)
    {
        try {
            $task_id = Hashids_decode($request->task_id);
            Task::where('id', $task_id)->update(['status' => 'completed']);
            milestone_completion_notification($task_id);

            $task = Task::where('id', $task_id)
                        ->first();
            $tasks = Task::where('estimate_id', $task->estimate_id)
                        ->where('status', null)
                        ->get();
            if($tasks->count() == null || $tasks->count() == 0){
                project_completed_notification($task->estimate_id);
            }
            return response()->json(['status' => $tasks]);
        } catch (\Exception $e) {

        }
    }

    public function reject_project(Request $request){
        try {
            $estimate = new Estimate();
            $estimate->project_id = $request->project_id;
            $estimate->tradesperson_id = Auth::user()->id;
            $estimate->project_awarded = 0;
            $estimate->status = null;
            $estimate->describe_mode = $request->reason;
            $estimate->unable_to_describe_type = null;
            $estimate->more_info = $request->more_details;
            $estimate->covers_customers_all_needs = 0;
            $estimate->payment_required_upfront = 0;
            $estimate->contingency = null;
            $estimate->initial_payment = null;
            $estimate->initial_payment_type = null;
            $estimate->project_start_date_type = null;
            $estimate->project_start_date = null;
            $estimate->total_time = null;
            $estimate->total_time_type = null;
            $estimate->terms_and_conditions = null;
            $estimate->save();

            return response()->json(['redirect_url' => route('tradepersion.projects')]);
        } catch (\Exception $e) {

        }
    }

}

