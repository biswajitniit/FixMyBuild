<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * A Project has a project address id
     */
    public function projectaddress()
    {
        return $this->belongsTo(Projectaddresses::class, 'project_address_id');
    }
}
