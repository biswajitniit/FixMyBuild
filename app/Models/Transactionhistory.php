<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactionhistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'task_id',
        'totalamount',
        'payment_status',
        'payment_type',
        'payment_transaction_id',
        'payment_capture_log',
        'payment_date'
    ];
}
