<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectEstimateFile extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'estimate_id',
        'file_name',
        'file_original_name',
        'file_extension',
        'url',
    ];

}
