<?php

namespace App\Http\Controllers\Tradepersion;

use App\Http\Controllers\Controller;
use App\Models\UkTown;
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
  Task
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

        $counties = UkTown::distinct()->pluck('county');

        return view('tradepersion.registrationtwo', compact('works', 'areas', 'counties', 'temp_company_logo', 'temp_public_liability_insurances', 'temp_comp_addresses', 'temp_trader_images', 'temp_team_imgs', 'temp_prev_projs'));
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

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect(route('tradepersion.compregistration'))
                        ->withInput()
                        ->withErrors($validator);
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
                $subareacovers = array_unique($request->subareacovers);
                // Get Old Area Covers
                $oldAreaCovers = Traderareas::where('user_id', Auth::user()->id)->get();
                foreach($subareacovers as $a){
                    $traderarea = new Traderareas();
                    $traderarea->user_id = Auth::user()->id;
                    $traderarea->sub_area_cover_id = $a;
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
        return view('tradepersion.registrationthree');
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
        $traderdetails->email_notification = json_encode([
            "new_quotes"=>$request->noti_new_quotes ?? 0,
            "quote_accepted"=>$request->noti_quote_accepted ?? 0,
            "project_stopped"=>$request->noti_project_stopped ?? 0,
            "quote_rejected"=>$request->noti_quote_rejected ?? 0,
            "project_cancelled"=> $request->noti_project_cancelled ?? 0,
        ]);

        if($traderdetails->save()){
            $notification = new stdClass();
            $notification->builder_amendment = $request->builder_amendment ? $request->builder_amendment : 0;
            $notification->noti_new_quotes = $request->noti_new_quotes ? $request->noti_new_quotes : 0;
            $notification->noti_quote_accepted = $request->noti_quote_accepted ? $request->noti_quote_accepted : 0;
            $notification->noti_project_stopped = $request->noti_project_stopped ? $request->noti_project_stopped : 0;
            $notification->noti_quote_rejected = $request->noti_quote_rejected ? $request->noti_quote_rejected : 0;
            $notification->noti_project_cancelled = $request->noti_project_cancelled ? $request->noti_project_cancelled : 0;
            $notijson = json_encode($notification);
            $notify = new Notification();
            $notify->user_id = Auth::user()->id;
            $notify->settings = $notijson;
            $notify->save();
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
    public function dashboard()
    {
        $works = Buildercategory::where('status', 'Active')->get();
        $areas = AreaCover::where('status', 1)->get();
        $trader_details = TraderDetail::where('user_id', Auth::user()->id)->first();
        // $trader_files = TradespersonFile::where('tradesperson_id', Auth::user()->id)->get();
        $company_logo = TradespersonFile::where(['tradesperson_id' => Auth::user()->id, 'file_related_to' => 'company_logo'])->first();
        $public_liability_insurances = TradespersonFile::where(['tradesperson_id' => Auth::user()->id, 'file_related_to' => 'public_liability_insurance'])->get();
        $team_images = TradespersonFile::where(['tradesperson_id' => Auth::user()->id, 'file_related_to' => 'team_img'])->get();
        $prev_project_images = TradespersonFile::where(['tradesperson_id' => Auth::user()->id, 'file_related_to' => 'prev_project_img'])->get();
        $trader_work = Traderworks::with('buildersubcategory')->where('user_id', Auth::user()->id)->get();
        $trader_area = Traderareas::with('subareas')->where('user_id', Auth::user()->id)->get();
        return view('tradepersion.dashboard', compact('works', 'areas', 'trader_details', 'trader_work', 'trader_area', 'company_logo', 'public_liability_insurances', 'team_images', 'prev_project_images'));
    }
    function storeTempTraderFile(Request $request)
    {

        try{
            $user = Auth::user()->id;

            $this->validate($request, [
                'file_related_to' => 'required|string',
            ]);

            $file = $request->file('file');
            $fileName = $request->file('file')->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $s3FileName = \Str::uuid().'.'.$extension;
            Storage::disk('s3')->put('Testfolder/'.$s3FileName, file_get_contents($file->getRealPath()));
            $path = Storage::disk('s3')->url('Testfolder/'.$s3FileName);

            $single_file_uploads = ['company_logo'];

            if( in_array($request->file_related_to, $single_file_uploads)){
                $delete_medias_after_save = tempmedia::where(['file_related_to'=> $request->file_related_to, 'media_type'=> 'tradesperson', 'user_id' => $user])->get();
            }

            $fileType = '';
            if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'gif' || $extension == 'svg' || $extension == 'webp' || $extension == 'heic' || $extension == 'heif')
                $fileType = 'image';
            else
                $fileType = 'document';

            $temp_media = new Tempmedia();
            $temp_media->user_id           = $user;
            $temp_media->sessionid         = session()->getId();
            $temp_media->file_type         = $fileType;
            $temp_media->media_type        = 'tradesperson';
            $temp_media->file_related_to   = $request->file_related_to;
            $temp_media->filename          = $fileName;
            $temp_media->file_extension    = $extension;
            $temp_media->url               = $path;
            $temp_media->file_created_date = now()->toDateString();
            $temp_media->save();

            if (isset($delete_medias_after_save) && !empty($delete_medias_after_save)) {
                $delete_medias_after_save->each(function ($media) {
                    $media->delete();
                });
            }

            return response()->json(['image_link'=>$path, 'file_name'=>$fileName]);
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
            $oldLogo   = TradespersonFile::where(['tradesperson_id' => Auth::user()->id, 'file_related_to' => 'company_logo'])->first();

            $companyLogo = new TradespersonFile();
            $companyLogo->tradesperson_id   = Auth::user()->id;
            $companyLogo->file_related_to   = 'company_logo';
            $companyLogo->file_type         = 'image';
            $companyLogo->file_name         = $fileName;
            $companyLogo->file_extension    = $extension;
            $companyLogo->url               = $path;
            if($companyLogo->save()){
                // Delete Old Logo
                TradespersonFile::where('id',$oldLogo->id)->delete();
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
        $list = $request->areatype;
        $deletetrader = Traderareas::where('user_id', Auth::user()->id)->delete();
        foreach($list as $a){
            $traderarea = new Traderareas();
            $traderarea->user_id = Auth::user()->id;
            $traderarea->sub_area_cover_id = $a;
            $traderarea->save();
        }

        $updated_data = Traderareas::where('user_id', Auth::user()->id)
                                ->with('subareas')
                                ->get();
        $builderSubcategoryName = [];

        foreach ($updated_data as $item) {
            array_push($builderSubcategoryName, $item->subareas->sub_area_type);
        }

        $data = array(
            'status' => 1,
            'areas' => $builderSubcategoryName,
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

            $image = $request->file('file');
            $fileName = $request->file('file')->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $s3FileName = \Str::of($fileName)->basename('.'.$extension).'_'.now()->format('Y_m_d_H_i_s').'_'.rand(1000,9999).'.'.$image->getClientOriginalExtension();
            $path = Storage::disk('s3')->put('Testfolder/'.$s3FileName,file_get_contents($image->getRealPath(),'public'));
            $path = Storage::disk('s3')->url('Testfolder/'.$s3FileName);

            $fileType = '';
            if ($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'gif' || $extension == 'svg' || $extension == 'webp' || $extension == 'heic' || $extension == 'heif')
                $fileType = 'image';
            else
                $fileType = 'document';

            // $tradesperson_file = new TradespersonFile();
            // $tradesperson_file->tradesperson_id   = Auth::user()->id;
            // $tradesperson_file->file_related_to   = $request->file_related_to;
            // $tradesperson_file->file_type         = $request->file_type;
            // $tradesperson_file->file_name          = $fileName;
            // $tradesperson_file->file_extension    = $extension;
            // $tradesperson_file->url               = $path;
            // $tradesperson_file->save();
            $tradesperson_file = TradespersonFile::create([
                'tradesperson_id' => Auth::user()->id,
                'file_related_to' => $request->file_related_to,
                'file_type'       => $fileType,
                'file_name'       => $fileName,
                'file_extension'  => $extension,
                'url'             => $path,
            ]);

            // return response()->json(['image_link'=>$path, 'id'=>]);
            return response()->json(['file' => $tradesperson_file]);
        } catch(\Exception $e) {
            return response()->json(['error' => 'Failed to store data'],500);
        }
    }

    public function projects()
    {
        // Projects for which the Tradesperson has written an estimate
        $estimate_projects = Estimate::where('tradesperson_id', Auth::user()->id)->with('project')->get();
        return view('tradepersion.projects', compact('estimate_projects'));
    }

    public function settings()
    {

        return view('tradepersion.settings');
    }

    public function project_estimate(Request $request,$key)
    {
        try{
            return view("tradepersion.estimate", ['project_id' => $key]);
        } catch(\Exception $e) {
            return 'error';
        }
    }


    public function projectestimate(Request $request)
    {
        try {
            $insert_estimate = new Estimate();
            $insert_estimate->project_id = $request->project_id;
            $insert_estimate->tradesperson_id = Auth::user()->id;
            // echo $request;die;
            if($request->describe_mode==null){
                $insert_estimate->describe_mode = 'Unable_to_describe ';
                if($request->Need_more_info!=null){
                    $insert_estimate->unable_to_describe_type = 'Need_more_info';
                }
                else if($request->Do_not_undertake_project_type!=null){
                    $insert_estimate->unable_to_describe_type = 'Do_not_undertake_project_type';
                }else{
                    $insert_estimate->unable_to_describe_type = 'Do_not_cover_location';
                }
                $insert_estimate->more_info = $request->typeHere;
                $insert_estimate->covers_customers_all_needs = 0;
                $insert_estimate->payment_required_upfront = 0;
                $insert_estimate->contingency = 0;
                $insert_estimate->initial_payment = 0;
                $insert_estimate->initial_payment_type = null;
                $insert_estimate->project_start_date_type = null;
                $insert_estimate->project_start_date = null;
                $insert_estimate->total_time = '';
                $insert_estimate->total_time_type = '';
                $insert_estimate->apply_vat = 0;
                $insert_estimate->terms_and_conditions = '';
                if($insert_estimate->save()){
                    return Redirect::back()->with('status', 'success');
                }else{
                    return Redirect::back()->with('status', 'error');
                }
            }else{
            $insert_estimate->describe_mode = $request->describe_mode;
            }
            if($request->covers_customers_all_needs == 0){
                $insert_estimate->covers_customers_all_needs = 0;
            }else{
                $insert_estimate->covers_customers_all_needs = $request->covers_customers_all_needs;
            }
            if($request->payment_required_upfront == 0){
                $insert_estimate->payment_required_upfront = 0;
                $insert_estimate->initial_payment = 0;
                $insert_estimate->initial_payment_type = null;
            }else{
                $insert_estimate->payment_required_upfront = $request->payment_required_upfront;
                if($request->initial_payment_percentage!=null){
                    $insert_estimate->initial_payment = $request->initial_payment_percentage;
                    $insert_estimate->initial_payment_type = 'Percentage';
                }else{
                    $insert_estimate->initial_payment = $request->initial_payment_amount;
                    $insert_estimate->initial_payment_type = 'Fixed';
                }

                }
            if($request->contingency == 0){
                $insert_estimate->contingency = 0;
            }else{
                $insert_estimate->contingency = $request->contingency;
            }
            $insert_estimate->project_start_date_type = $request->for_start_date;
            $insert_estimate->project_start_date = $request->project_start_date;
            $insert_estimate->total_time = $request->total_time;
            $insert_estimate->total_time_type = $request->total_time_type;

            if($request->apply_vat==null){
                $insert_estimate->apply_vat = 0;
            }else{
            $insert_estimate->apply_vat = $request->apply_vat;
            }
            $insert_estimate->terms_and_conditions = $request->termsconditions;

            if($insert_estimate->save())
            {
                echo $insert_estimate;
                if($request->describe_mode!=null){
                    $estimate_id = Estimate::where('tradesperson_id',Auth::user()->id)->where('project_id',$request->project_id)->first();
                    for($i=1;$i<=$request->total_field;$i++){
                        $insert_task = new Task();
                        $insert_task->estimate_id = $estimate_id->id;
                        $insert_task->description = $request->input('task'."$i");
                        $insert_task->price = $request->input('amount'."$i");
                        $insert_task->save();
                    }
                }

                return Redirect::back()->with('status', 'success');
            }else{
                return Redirect::back()->with('status', 'error');
            }
        } catch (Exception $e) {
            echo $e;die;
        }
    }


    public function details(Request $request, $id)
    {
        $project = Project::where('id', $id)->first();
        $projectid = Projectfile::where('project_id', $request->project_id)->get();
        $trader_detail = TraderDetail::where('user_id', Auth::user()->id)->first();
        $estimate = Estimate::where('project_id', $request->project_id)
                            ->where('tradesperson_id', Auth::user()->id)
                            ->first();
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
        $taskTotalAmount = number_format($taskTotalAmount, 2);
        $taskAmountWithContingency = number_format($taskAmountWithContingency, 2);
        $taskAmountWithContingencyAndVat = number_format($taskAmountWithContingencyAndVat, 2);
        $initial_payment_percentage = number_format($initial_payment_percentage, 2);
        $contingency_per_task = number_format($contingency_per_task, 2);

        return view('tradepersion.project_details',compact('projectid','project','trader_detail','estimate','tasks','taskTotalAmount','taskAmountWithContingency','taskAmountWithContingencyAndVat','initial_payment_percentage','contingency_per_task'));
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
        } catch (Exception $e){
            echo "error"; die;
        }

    }

    public function update_task_status(Request $request)
    {
        try {
            Task::where('id', $request->task_id)->update(['status' => $request->status]);
            return response()->json(['status' => $request->input('status')]);
        } catch (Exception $e) {

        }
    }

}
