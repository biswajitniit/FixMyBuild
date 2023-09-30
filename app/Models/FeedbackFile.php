<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackFile extends Model
{
    use HasFactory;


    protected $fillable = [
        'project_id',
        'file_type',
        'file_name',
        'file_original_name',
        'file_extension',
        'url',
    ];
}
