<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Terms extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name','terms_order','status',
     ];

    // public function buildersubcategories()
    // {
    //     return $this->hasMany(Buildersubcategory::class, 'builder_category_id', 'id');
    // }
}
