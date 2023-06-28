<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projectnotesandcommend extends Model
{
    use HasFactory;




    public function projectnotesandcommends(){
        return $this->belongsTo(Project::class,'project_id');
    }
}
