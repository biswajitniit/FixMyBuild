<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Project;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Support\Facades\Storage;
use Aws\S3\Exception\S3Exception;
use Illuminate\Support\Str;
class ChatController extends BaseController
{
    /********************************************************
    *
    **************** Get User List **********
    *
    *********************************************************/
    public function index(Request $request){
        try{
           /* $chat =  DB::select('
                    SELECT t1.*, u.name
                    FROM chat AS t1
                    INNER JOIN
                    (
                        SELECT
                            LEAST(from_user_id, to_user_id) AS from_user_id,
                            GREATEST(from_user_id, to_user_id) AS to_user_id,
                            MAX(id) AS max_id
                        FROM chat
                        GROUP BY
                            LEAST(from_user_id, to_user_id),
                            GREATEST(from_user_id, to_user_id)
                    ) AS t2
                        ON LEAST(t1.from_user_id, t1.to_user_id) = t2.from_user_id AND
                        GREATEST(t1.from_user_id, t1.to_user_id) = t2.to_user_id AND
                        t1.id = t2.max_id
                        WHERE t1.from_user_id = ? OR t1.to_user_id = ?
                    ', [$request->userid, $request->userid]);
            return response()->json($chat,200); */

            $chat = DB::select('select c.id, c.created_at, c.message, u.name, u.profile_image, c.from_user_id, c.to_user_id FROM users AS u LEFT JOIN chat AS c ON c.from_user_id = u.id WHERE c.id IN ( SELECT MAX(id) FROM chat WHERE (from_user_id = '.$request->userid.' OR to_user_id = '.$request->userid.') OR (from_user_id = '.$request->userid.' OR to_user_id = '.$request->userid.') GROUP BY LEAST(from_user_id, to_user_id), GREATEST(from_user_id, to_user_id))');
            return response()->json($chat,200);

        }catch(Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }

    /********************************************************
    *
    **************** Get User Chat List **********
    *
    *********************************************************/
    public function get_chat_details_by_two_user(Request $request){
        try{
            $chat =  DB::select('select * FROM chat where from_user_id = '.$request->from_user_id.' and to_user_id = '.$request->to_user_id.' union select * FROM chat where from_user_id = '.$request->to_user_id.' and to_user_id = '.$request->from_user_id.' Order by id asc');
            return response()->json($chat,200);
        }catch(Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }
    /********************************************************
    *
    **************** Get User Unread chat count **********
    *
    *********************************************************/
    public function get_unread_chat_count_two_user(Request $request){
        try{
            $chat =  DB::select('SELECT COUNT(*) unread FROM chat WHERE (from_user_id = '.$request->from_user_id.' AND to_user_id = '.$request->to_user_id.' AND read_status = 0) OR (from_user_id = '.$request->to_user_id.' AND to_user_id = '.$request->from_user_id.' AND read_status = 0)');
            return response()->json($chat,200);
        }catch(Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }
    /********************************************************
    *
    **************** Get User Unread chat count **********
    *
    *********************************************************/
    public function send_messages(Request $request){
        try{

            if($request->hasFile('document')){
                $file = $request->file('document');
                $fileName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $s3FileName = \Str::uuid().'.'.$extension;
                Storage::disk('s3')->put('chats/'.$s3FileName, file_get_contents($file->getRealPath()));
                $path = Storage::disk('s3')->url('chats/'.$s3FileName);
            }else{
                $path = '';
            }

            $insert_msg = new Chat();
            $insert_msg->from_user_id = $request->input('from_user_id');
            $insert_msg->to_user_id = $request->input('to_user_id');
            $insert_msg->project_id = $request->input('project_id');
            $insert_msg->estimate_id = $request->input('estimate_id');
            $insert_msg->message = $request->message;
            $insert_msg->documents_url =  $path;
            $insert_msg->save();

            return response()->json(['message' => 'Message Send Successfully.', 'last_insert_id' => $insert_msg->id]);
        }catch(Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }


}
