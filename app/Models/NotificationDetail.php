<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationDetail extends Model
{
    use HasFactory;

    // public function count_all()
    // {
    //     return DB::table('notification_details')
    //                                 ->where('read_status', 0)
    //                                 ->where('user_id', Auth::user()->id)
    //                                 ->count();

    // }
}
