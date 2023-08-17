<?php

namespace App\Http\Controllers;

use App\Models\Chat;
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



    // public function load($reciever, $sender){
    //     $boxType = "";

    //     $id1 = Message_Users::where('sender_id', $sender)->where('reciever_id',$reciever)->pluck('id');
    //     $id2 = Message_Users::where('reciever_id', $sender)->where('sender_id',$reciever)->pluck('id');

    //     $allMessages = Chat::where('message_users_id', $id1)->orWhere('message_users_id', $id2)->orderBy('id', 'asc')->get();

        // foreach($allMessages as $row){
        //     if($id1[0]==$row['message_users_id']){$boxType = "p-2 recieverBox ml-auto";}else{$boxType = "float-left p-2 mb-2 senderBox";}
        //     echo "<div class='p-2 d-flex'>";
        //     echo "<div class='".$boxType."'>";
        //     echo "<p>".$row['message']."</p>";
        //     echo "</div>";
        //     echo "</div>";
        // }
    //     $tobePassed = [$allMessages, $id1];
    //     return $tobePassed;
    // }

    // public function retrieveNew($reciever, $sender, $lastId){
    //     $id1 = Message_Users::where('sender_id', $sender)->where('reciever_id',$reciever)->pluck('id');
    //     $id2 = Message_Users::where('reciever_id', $sender)->where('sender_id',$reciever)->pluck('id');

    //     $allMessages = Chat::where('id','>=',$lastId)->where('message_users_id', $id2)->orderBy('id', 'asc')->get();

    //     return $allMessages;
    // }
}
