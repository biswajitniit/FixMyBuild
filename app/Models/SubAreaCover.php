<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubAreaCover extends Model
{
    use HasFactory;

    protected $fillable = [
        'area_type_id',
        'sub_area_type',
        'status',
    ];

    
    public function area()
    {
        return $this->hasOne(AreaCover::class, 'id', 'area_type_id');
    }
}
