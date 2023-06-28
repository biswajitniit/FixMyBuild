<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Projectaddresses;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AddressController extends Controller
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
    
}
