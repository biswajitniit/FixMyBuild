<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'from_user_id',
        'from_user_type',
        'related_to',
        'related_to_id',
        'read_status',
        'notification_text',
        'reviewer_note',
    ];


    public function from_user_details()
    {
        return $this->belongsTo(User::class, 'from_user_id', 'id');
    }
}
