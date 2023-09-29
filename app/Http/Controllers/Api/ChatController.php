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

class ChatController extends BaseController
{
    /********************************************************
    *
    **************** Get User List **********
    *
    *********************************************************/
    public function index(Request $request){
        try{
            $chat =  DB::select('
                    SELECT t1.*
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
            return response()->json($chat,200);
        }catch(Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }
}
