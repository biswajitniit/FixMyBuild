<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buildercategory extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'builder_category_name','status',
     ];

    public function buildersubcategories()
    {
        return $this->hasMany(Buildersubcategory::class, 'builder_category_id', 'id');
    }
}
