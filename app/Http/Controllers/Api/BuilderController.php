<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Buildercategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BuilderController extends Controller
{
    public function get_builders(Request $request){
        $data = Buildercategory::with('buildersubcategories')->where('status', 'Active')->get();
        return response()->json($data,200);
    }

    public function save_traders_details(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'comp_reg_no' => 'required',
            'comp_name' => 'required',
            'comp_address' => 'required',
            'trader_name' => 'required|string',
            'comp_description' => 'required',
            'name' => 'required',
            'phone_code' => 'required',
            'phone_number' => 'required',
            'phone_office' => 'required|string',
            'email' => 'required',
            'designation' => 'required',
            'vat_reg' => 'required',
            'vat_no' => 'required',
            'vat_comp_name' => 'required|string',
            'vat_comp_address' => 'required',
            'contingency' => 'required',
            'bnk_account_type' => 'required',
            'bnk_account_name' => 'required',
            'bnk_sort_code' => 'required|string',
            'bnk_account_number'=> 'required|string',
            'builder_amendment'=> 'required|string',
            'noti_new_quotes'=> 'required|string',
            'noti_quote_accepted'=> 'required|string',
            'noti_project_stopped'=> 'required|string',
            'noti_quote_rejected'=> 'required|string',
            'noti_project_cancelled'=> 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    }

}
