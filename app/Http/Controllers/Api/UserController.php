<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function change_password(Request $request){
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed',
            'old_password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $user = User::where('id','=',$request->user()->id)
        ->where('password',Hash::check($request->old_password))
        ->update(['password'=>Hash::make($request->password)]);
        if(!$user){
            return response()->json(['message'=>'Worng password'],400);
        }
        
        return response()->json(['message'=>'Otp verified'],200);
    }
    public function get_profile(Request $request){
        try{
            $user = User::where('id','=',$request->user()->id)->first();
        return response()->json($user,200);
        }catch(Exception $e){
        return response()->json($e->getMessage(),500);
        }
    }
}
