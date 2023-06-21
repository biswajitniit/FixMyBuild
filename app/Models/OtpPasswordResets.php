<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtpPasswordResets extends Model
{
    use HasFactory;

    protected $fillable = [
        'otp',
        'used',
    ];
}
