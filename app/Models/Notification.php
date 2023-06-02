<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;


class Notification extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'settings'
    ];
    protected $casts = [
        'settings' => 'json'
    ];

}
