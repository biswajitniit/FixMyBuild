<?php

namespace App\Http\Controllers\Tradepersion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buildercategory;
use App\Models\AreaCover;
use App\Models\SubAreaCover;
use App\Models\TraderDetail;
use App\Models\Traderareas;
use App\Models\Traderworks;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Auth;
use Redirect;

class TradepersionDashboardController extends Controller
{
    public function registrationsteptwo()
    {
        $works = Buildercategory::where('status', 'Active')->get();
        $areas = AreaCover::where('status', 1)->get();
        return view('tradepersion.registrationtwo', compact('works', 'areas'));
    }

    public function saveregistrationsteptwo(Request $request){
        $this->validate($request, [
			'comp_reg_no'       => 'required',
			'comp_name'         => 'required',
			'trader_name'       => 'required',
			'comp_description'  => 'required',
			'name'              => 'required',
            'phone_code'        => 'required',
            'phone_number'      => 'required',
            'email'             => 'required',
            'designation'       => 'required',
            'vat_reg'           => 'required',
            'subworktype'       => 'required',
            'subareacovers'     => 'required',

        ],[
            'comp_reg_no.required'      => 'Please enter company registration number and validate',
            'comp_name.required'        => 'Please enter company registration number and validate',
            'trader_name.required'      => 'Please enter your trader name',
            'comp_description.required' => 'Please enter your company descriptions',
            'name.required'             => 'Please enter your name',
            'phone_code.required'       => 'Please select your phone code',
            'phone_number.required'     => 'Please enter your phone number',
            'email.required'            => 'Please enter your email',
            'designation.required'      => 'Please enter your designation',
            'vat_reg.required'          => 'Please enter your vat number and validate',
            'subworktype.required'      => 'Please select work you do',
            'subareacovers.required'    => 'Please select area do you cover',
        ]);

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
        $traderdetails->phone_office = $request->phone_office;
        $traderdetails->email = $request->email;
        $traderdetails->company_role = $request->company_role;
        $traderdetails->designation = $request->designation;
        $traderdetails->vat_reg = $request->vat_reg;
        $traderdetails->vat_no = $request->vat_no;
        $traderdetails->vat_comp_name = $request->vat_comp_name;
        $traderdetails->vat_comp_address = $request->vat_comp_address;
        if($traderdetails->save()){
            $userstatus = User::where('id', Auth::user()->id)->update(['steps_completed' => "2"]);
            if($request->subworktype){
                foreach($request->subworktype as $w){
                    $traderwork = new Traderworks();
                    $traderwork->user_id = Auth::user()->id;
                    $traderwork->buildersubcategory_id = $w;
                    $traderwork->save();
                }
            }
            if($request->subareacovers){
                foreach($request->subareacovers as $a){
                    $traderarea = new Traderareas();
                    $traderarea->user_id = Auth::user()->id;
                    $traderarea->sub_area_cover_id = $a;
                    $traderarea->save();
                }
            }
            return redirect()->intended('/tradeperson/bank-registration');
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
        $traderdetails->builder_amendment = $request->builder_amendment;
        $traderdetails->noti_new_quotes = $request->noti_new_quotes;
        $traderdetails->noti_quote_accepted = $request->noti_quote_accepted;
        $traderdetails->noti_project_stopped = $request->noti_project_stopped;
        $traderdetails->noti_quote_rejected = $request->noti_quote_rejected;
        $traderdetails->noti_project_cancelled = $request->noti_project_cancelled;
        if($traderdetails->save()){
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
        $trader_work = Traderworks::with('buildersubcategory')->where('user_id', Auth::user()->id)->get();
        $trader_area = Traderareas::with('subareas')->where('user_id', Auth::user()->id)->get();
        return view('tradepersion.dashboard', compact('works', 'areas', 'trader_details', 'trader_work', 'trader_area'));
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
                'message' => "Description has been successfully updated"
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
        $traderdetails->phone_office = $request->contactOfficeMobile;
        $traderdetails->email = $request->contactEmail;
        if($traderdetails->save()){
            $data = array(
                'status' => 1,
                'message' => "Contacts has been successfully updated"
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
       
        $data = array(
            'status' => 1,
            'message' => "Type of work undertaken has been successfully updated"
        );
        return $data;
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
       
        $data = array(
            'status' => 1,
            'message' => "Area covered has been successfully updated"
        );
        return $data;
    }

    public function projects()
    {
        return view('tradepersion.projects');
    }

    public function settings()
    {
        return view('tradepersion.settings');
    }
}