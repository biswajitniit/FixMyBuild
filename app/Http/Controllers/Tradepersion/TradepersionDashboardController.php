<?php

namespace App\Http\Controllers\Tradepersion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WorkType;
use App\Models\AreaCover;
use App\Models\SubWorkType;
use App\Models\SubAreaCover;
use App\Models\TraderDetail;

class TradepersionDashboardController extends Controller
{
    public function registrationsteptwo()
    {
        $works = WorkType::where('status', 1)->get();
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
            'phone_office'      => 'required',
            'email'             => 'required',
            'designation'       => 'required',
            'vat_reg'           => 'required',
            'vat_no'            => 'required',
            'vat_comp_name'     => 'required',
            'vat_comp_address'  => 'required',
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
            'phone_office.required'     => 'Please enter your name',
            'email.required'            => 'Please enter your email',
            'designation.required'      => 'Please enter your designation',
            'vat_reg.required'          => 'Please enter your vat number and validate',
            'vat_no.required'           => 'Please enter your vat number and validate',
            'vat_comp_name.required'    => 'Please enter your vat number and validate',
            'vat_comp_address.required' => 'Please enter your vat number and validate',
            'subworktype.required'      => 'Please select work you do',
            'subareacovers.required'    => 'Please select area do you cover',
        ]);

        $traderdetails = new TraderDetail();
        $traderdetails->user_id = Auth::user()->id;
        $traderdetails->comp_reg_no = $request()->comp_reg_no;
        $traderdetails->comp_name = $request()->comp_name;
        $traderdetails->comp_address = $request()->comp_address;
        $traderdetails->trader_name = $request()->trader_name;
        $traderdetails->comp_description = $request()->comp_description;
        $traderdetails->name = $request()->name;
        $traderdetails->phone_code = $request()->phone_code;
        $traderdetails->phone_number = $request()->phone_number;
        $traderdetails->phone_office = $request()->phone_office;
        $traderdetails->email = $request()->email;
        $traderdetails->designation = $request()->designation;
        $traderdetails->vat_reg = $request()->vat_reg;
        $traderdetails->vat_no = $request()->vat_no;
        $traderdetails->vat_comp_name = $request()->vat_comp_name;
        $traderdetails->vat_comp_address = $request()->vat_comp_address;
        if($traderdetails->save()){
            $userstatus = User::where('id', Auth::user()->id)->update(['steps_completed' => "2"]);
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
}
