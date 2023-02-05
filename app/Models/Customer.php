<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
     /**
     * @return BelongsTo
     * @description Get the post that owns the details
     */
    public function user()
    {
        return $this->belongsTo(User::class,'customer_id');
    }
}
