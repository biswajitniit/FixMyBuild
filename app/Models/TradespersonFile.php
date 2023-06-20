<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TradespersonFile extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tradesperson_id',
        'file_related_to',
        'file_type',
        'file_name',
        'file_extension',
        'url',
    ];

    public function tradesperson() {
        return $this->belongsTo(User::class);
    }
}
