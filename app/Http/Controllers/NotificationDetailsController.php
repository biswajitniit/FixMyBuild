<?php

namespace App\Http\Controllers;

use App\Models\NotificationDetail;
use Illuminate\Http\Request;
use Auth;

class NotificationDetailsController extends Controller
{
    public function detailed_notification(Request $request)
    {
        $notifications = NotificationDetail::where('user_id', Auth::user()->id)->get();
        return view("all_notifications.notification_detail", ['notifications' => $notifications]);
    }


    public function read_all_notifications(Request $request)
    {
        try {
            NotificationDetail::where('read_status', 0)
                            ->where('user_id', Auth::user()->id)
                            ->update([
                                'read_status' => 1
                            ]);
            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            echo 'error';die;
        }
    }
}
