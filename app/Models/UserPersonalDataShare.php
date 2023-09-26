<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPersonalDataShare extends Model
{
    use HasFactory;

    protected $casts = [
        'settings' => 'json'
    ];

    protected $fillable = [
        'user_id',
        'project_id',
        'tradeperson_id',
        'settings',
    ];
}
