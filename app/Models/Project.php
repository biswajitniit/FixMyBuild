<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id',
        'project_address_id',
        'forename',
        'surname',
        'project_name',
        'description',
        'contact_mobile_no',
        'contact_email',
        'notes'
    ];

    /**
     * A Project has a project address id
     */
    public function projectaddress()
    {
        return $this->belongsTo(Projectaddresses::class, 'project_address_id');
    }

    public function projectfile(){
        return $this->belongsTo(Projectfile::class,'project_id');
    }
    public function projectfiles(){
        return $this->hasMany(Projectfile::class);
    }
    public function projectnotesandcommends(){
        return $this->hasMany(Projectnotesandcommend::class);
    }
}
