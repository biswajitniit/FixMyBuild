<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projectaddresses extends Model
{
    use HasFactory;


    /**
     * Regions have many Project
     */
    public function project()
    {
        return $this->hasMany(Project::class);
    }
}
