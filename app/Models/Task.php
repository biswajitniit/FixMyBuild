<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'description',
        'price',
        'estimate_id',
        'contingency',
        'max_contingency',
        'payment_status',
        'status',
        'payment_transaction_id',
        'payment_date',
        'is_initial',
    ];

    public function estimate() {
        return $this->belongsTo(Estimate::class);
    }
}
