<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projectfile extends Model
{
    use HasFactory;



    public function projectfiles(){
        return $this->belongsTo(Project::class,'project_id');
    }
}
