<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traderworks extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'buildersubcategory_id'
    ];

    /**
     * Get the user associated with the Traderworks
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function buildersubcategory()
    {
        return $this->hasOne(Buildersubcategory::class, 'id', 'buildersubcategory_id');
    }
}
