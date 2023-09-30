<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projectfile extends Model
{
    use HasFactory;


    protected $fillable = [
        'project_id',
        'file_type',
        'filename',
        'file_original_name',
        'file_extension',
        'url'
    ];

    public function project(){
        return $this->belongsTo(Project::class,'project_id');
    }
}
