<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id',
        'builder_category_id',
        'builder_subcategory_id',
        'forename',
        'surname',
        'project_name',
        'description',
        'contact_mobile_no',
        'contact_home_phone',
        'contact_email',
        'postcode',
        'county',
        'town',
        'categories',
        'subcategories',
        'customer_note',
        'tradeperson_note',
        'internal_note',
        'status',
        'reviewer_id',
        'reviewer_status',
        'reviewer_status_updated_at',
        'notes'
    ];

    /**
     * A Project has a project address id
     */
    public function projectaddress()
    {
        // return $this->belongsTo(Projectaddresses::class, 'project_address_id');
        return $this->hasOne(Projectaddresses::class, 'project_id');
    }

    public function projectfile(){
        return $this->belongsTo(Projectfile::class,'project_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function projectfiles(){
        return $this->hasMany(Projectfile::class);
    }

    public function projectnotesandcommends(){
        return $this->hasMany(Projectnotesandcommend::class);
    }

    public function subCategories()
    {
        return $this->belongsToMany(Buildersubcategory::class, 'project_categories', 'project_id', 'sub_category_id');
    }

    public function estimates()
    {
        return $this->hasMany(Estimate::class);
    }
}
