<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Projectaddresses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\Postcode;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AddressController extends BaseController
{
    public function index(Request $request){
        $address = Projectaddresses::where('user_id',$request->user()->id)->get();
        return response()->json($address,200);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'address_line_one' => 'required|string',
            'address_line_two' => 'required|string',
            'town_city' => 'required|string',
            'postcode' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try{
            $address = Projectaddresses::create([
                'user_id'=>$request->user()->id,
                'address_line_one'=> $request->address_line_one,
                'address_line_two'=>$request->address_line_two,
                'town_city' => $request->town_city,
                'postcode' => $request->postcode
            ]);
            if (!$address) {
                throw ValidationException::withMessages(['message' => 'Something went wrong, please try again!'], 400);
            }
            return response()->json(['message'=>'Address saved successfully'],200);
        } catch(Exception $e){
            return response()->json(['error'=>$e],500);
        }
    }


    public function last_used_address() {

        try {
            $last_used_project = Project::where('user_id', request()->user()->id)->latest()->first();
            $last_used_address = Projectaddresses::where('project_id', $last_used_project->id)->first();

            $resultant_data = [
                'county' => $last_used_project->county,
                'town' => $last_used_project->town,
                'postcode' => $last_used_project->postcode,
                'address_line_one' => $last_used_address->address_line_one,
                'address_line_two' => $last_used_address->address_line_two,
            ];

            return $this->success($resultant_data, 200);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 500);
        }

    }


    public function get_area_from_postcode(Request $request) {
        $validator = Validator::make($request->all(), [
            'postcode' =>'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            return Postcode::where('Postcode', 'like', '%'.$request->postcode.'%')->get();
        } catch (ModelNotFoundException $e) {
            return $this->error('Postcode not found.', 404);
        } catch (Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }
}
