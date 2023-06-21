<?php

namespace App\Http\Controllers\Tradepersion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buildercategory;
use App\Models\AreaCover;
use App\Models\Estimate;
use App\Models\Project;
use App\Models\Projectfile;
use App\Models\SubAreaCover;
use App\Models\Task;
use App\Models\TraderDetail;
use App\Models\Traderareas;
use App\Models\Traderworks;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Beta\Microsoft\Graph\ExternalConnectors\Model\Schema;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
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
        } catch (Exception $e) {

        }
    }

}
