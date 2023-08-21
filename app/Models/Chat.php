<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $table = 'chat';

    protected $fillable = [
        'id',
        'to_user_id',
        'from_user_id',
        'message',
        'project_id',
        'estimate_id',
        'is_bookmarked'
    ];
}
