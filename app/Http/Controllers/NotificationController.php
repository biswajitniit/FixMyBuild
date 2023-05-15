<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function index()
    {
        return view("customer.notifications");
    }


    public function data_store(Request $request)
    {
        try {
            $data = Notification::where('user_id','=', $request->userid)->get();
            if(count($data) == 0){
                $data = new Notification();
                $data->user_id=$request->userid;
                $data->settings=$request->settings;
                $data->save();
                $data2 = Notification::where('user_id','=', $request->userid)->get();
                return response()->json(["message"=>$data2[0]]);
            }
            else{
                $data = DB::table('notifications')->where('user_id', '=', $request->userid)->update(array('settings' => $request->settings));
                $data2 = Notification::where('user_id','=', $request->userid)->get();
                return response()->json(["message"=>$data2[0]]);
            }

        } catch (Exception $e) {
            return response()->json(["message"=>$e->getMessage()]);

        }
    }
    public function get_notification_data(){
        try {
            $data2 = Notification::where('user_id','=', Auth::user()->id)->get();
            return response()->json(["message"=>$data2[0]]);
        } catch (Exception $e) {
            return response()->json(["message"=>$e->getMessage()]);

        }
    }
}
