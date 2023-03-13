<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buildersubcategory extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'builder_category_id',
        'builder_subcategory_name',
        'status',
     ];

     public function Buildercategory(){
        return $this->belongsTo(Buildercategory::class,'builder_category_id');
     }

}
