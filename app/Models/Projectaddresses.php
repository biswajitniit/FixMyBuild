<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projectaddresses extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'address_line_one',
        'address_line_two',
        'town_city',
        'postcode',
    ];

    /**
     * Regions have many Project
     */
    public function project()
    {
        return $this->hasMany(Project::class);
    }
}
