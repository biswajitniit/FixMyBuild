<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Notification;
use App\Models\NotificationDetail;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function submit_msg(Request $request)
    {
        try{
            $insert_msg = new Chat();
            $insert_msg->from_user_id = $request->input('from_user_id');
            $insert_msg->to_user_id = $request->input('to_user_id');
            $insert_msg->project_id = $request->input('project_id');
            $insert_msg->estimate_id = $request->input('estimate_id');
            $insert_msg->message = $request->message;
            $insert_msg->save();

            return response()->json(['message' => $request->input('message'), 'last_insert_id' => $insert_msg->id]);
        } catch (\Exception $e) {
            echo ($e);die;
        }
    }

    public function retrieveNew(Request $request)
    {
        $project = Project::where('id', $request->project_id)->first();
        $customer = User::where('id', $project->user_id)->first();

        $id1 = Chat::where('from_user_id', $request->from_user_id)
                    ->where('to_user_id',$request->to_user_id)
                    ->pluck('id');
        $id2 = Chat::where('to_user_id', $request->to_user_id)
                    ->where('from_user_id',$request->from_user_id)
                    ->pluck('id');

        $allMessages = Chat::where('id','>=',$request->last_msg_id)
                            ->where('from_user_id', $request->from_user_id)
                            ->where('to_user_id', $request->to_user_id)
                            ->orderBy('id', 'asc')
                            ->get();

        // for unread msg, notification and mail send
        $chat = Chat::where('id','>=',$request->last_msg_id)->first();
        $user = Chat::where('to_user_id', $request->to_user_id)->first();

        $chat->created_at = now()->addMinutes(30);
        if(strtotime($chat->created_at) < strtotime(now()) && $chat->read_status == 0)
        {
            // Check Notification settings for customer
            $notify_settings = Notification::where('user_id', $user->id)->first();
            if($notify_settings) {
                if($notify_settings->settings != null){
                    $new_msg = $notify_settings->settings['project_new_message'];
                } else {
                    $new_msg = 1;
                }
            }
            // Notification
            if($new_msg == 1){
                $html = view('email.unread-msg-for-chat.blade')
                                ->with('data', [
                                'customer_name'       => $user->name,
                                'trader_name'         => Auth::user()->customer_or_tradesperson,
                                ])
                                ->render();
                $emaildata = array(
                    'From'          =>  env('MAIL_FROM_ADDRESS'),
                    'To'            =>  $user->email,
                    'Subject'       => 'You have received a new message',
                    'HtmlBody'      =>  $html,
                    'MessageStream' => 'outbound'
                );
                $email_sent = send_email($emaildata);

                // Notificatin Insert in DB
                $notificationDetail = new NotificationDetail();
                $notificationDetail->user_id = $user->id;
                $notificationDetail->from_user_id = Auth::user()->id;
                $notificationDetail->from_user_type = Auth::user()->customer_or_tradesperson;
                $notificationDetail->related_to = 'chat';
                $notificationDetail->related_to_id = $chat->id;
                $notificationDetail->read_status = 0;
                $notificationDetail->notification_text = 'You have received a new message from'.$user->name;
                $notificationDetail->reviewer_note = null;
                $notificationDetail->save();
            }
        }

        return $allMessages;
    }


    public function load(Request $request)
    {
        // $boxType = "";

        // $id1 = Chat::where('from_user_id', $request->from_user_id)
        //             ->where('to_user_id',$request->to_user_id)
        //             ->pluck('id');
        // $id2 = Chat::where('to_user_id', $request->from_user_id)
        //             ->where('from_user_id',$request->to_user_id)
        //             ->pluck('id');

        // $allMessages = Chat::where('from_user_id', $id1)
        //                     ->orWhere('from_user_id', $id2)
        //                     ->orderBy('id', 'asc')
        //                     ->get();

        // foreach($allMessages as $row)
        // {
        //     if($id1[0]==$row['from_user_id'])
        //     {
        //         $boxType = "p-2 recieverBox ml-auto";
        //     }else{
        //         $boxType = "float-left p-2 mb-2 senderBox";
        //     }
        //     echo "<div class='p-2 d-flex'>";
        //     echo "<div class='".$boxType."'>";
        //     echo "<p>".$row['message']."</p>";
        //     echo "</div>";
        //     echo "</div>";
        // }
        // $tobePassed = [$allMessages, $id1];
        // return $tobePassed;

        $allMessages = Chat::where(function($query) use ($request) {
            $query->where('from_user_id', $request->from_user_id)->where('to_user_id', $request->to_user_id);
        })->orWhere(function($query) use ($request) {
            $query->where('to_user_id', $request->from_user_id)->where('from_user_id', $request->to_user_id);
        })->get();

        return $allMessages;
    }


    // for unread msg, notification and mail send for customer
    // $chat = Chat::where('id','>=',$request->last_msg_id)->first();
    // $user = Chat::where('to_user_id', $request->to_user_id)->first();

    // $chat->created_at = now()->addMinutes(30);
    // if(strtotime($chat->created_at) < strtotime(now()) && $chat->read_status == 0)
    // {
    //     // Check Notification settings for tradeperson
    //     $notify_settings = Notification::where('user_id', $user->id)->first();
    //     if($notify_settings) {
    //         if($notify_settings->settings != null){
    //             $new_msg = $notify_settings->settings['noti_new_message'];
    //         } else {
    //             $new_msg = 1;
    //         }
    //     }
    //     // Notification
    //     if($new_msg == 1){
    //         $html = view('email.unread-msg-for-chat.blade')
    //                         ->with('data', [
    //                         'trader_name'       => $user->name,
    //                         'customer_name'     => Auth::user()->customer_or_tradesperson;
    //                         ])
    //                         ->render();
    //         $emaildata = array(
    //             'From'          =>  env('MAIL_FROM_ADDRESS'),
    //             'To'            =>  $user->email,
    //             'Subject'       => 'You have received a new message',
    //             'HtmlBody'      =>  $html,
    //             'MessageStream' => 'outbound'
    //         );
    //         $email_sent = send_email($emaildata);

    //         // Notificatin Insert in DB
    //         $notificationDetail = new NotificationDetail();
    //         $notificationDetail->user_id = $user->id;
    //         $notificationDetail->from_user_id = Auth::user()->id;
    //         $notificationDetail->from_user_type = Auth::user()->customer_or_tradesperson;
    //         $notificationDetail->related_to = 'chat';
    //         $notificationDetail->related_to_id = $chat->id;
    //         $notificationDetail->read_status = 0;
    //         $notificationDetail->notification_text = 'You have received a new message from'.$user->name;
    //         $notificationDetail->reviewer_note = null;
    //         $notificationDetail->save();
    //     }
    // }
}
