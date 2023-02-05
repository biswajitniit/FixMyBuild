<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaCover extends Model
{
    use HasFactory;

    protected $fillable = [
        'area_type',
        'status',
    ];

    
    public function subareas()
    {
        return $this->hasMany(SubAreaCover::class, 'area_type_id', 'id');
    }
}
