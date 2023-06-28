<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traderareas extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'sub_area_cover_id'
    ];

    /**
     * Get the user associated with the Traderareas
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function subareas()
    {
        return $this->hasOne(SubAreaCover::class, 'id', 'sub_area_cover_id');
    }
}
