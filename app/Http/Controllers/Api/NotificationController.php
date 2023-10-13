<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\NotificationCollection;
use Exception;
use Illuminate\Http\Request;
use App\Models\NotificationDetail;
use App\Http\Controllers\Controller;

class NotificationController extends BaseController
{
    // Show list of notifications to the auth user
    public function index()
    {
        try {
            $notifications = NotificationDetail::where('user_id', request()->user()->id)->with('from_user_details');

            // As soon as the notifications are fetched, mark all the notifications as read
            $notifications->update(['read_status' => 1]);

            $notifications = $notifications->get();

            return $this->success(['notifications' => new NotificationCollection($notifications)]);
        } catch (Exception $e) {
            return $this->error(['errors' => $e->getMessage()]);
        }
    }


    // Checks if the currently logged in user has any unread notifications
    public function has_unread_notifications()
    {
        try {
            $unread_message_counts = NotificationDetail::where([
                'user_id'=> request()->user()->id,
                'read_status'=> 0,
            ])->count();

            return $this->success(['message' => $unread_message_counts > 0 ? true : false]);
        } catch (Exception $e) {
            return $this->error(['errors' => $e->getMessage()]);
        }
    }
}
