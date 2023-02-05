<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubWorkType extends Model
{
    use HasFactory;
    protected $fillable = [
        'work_type_id',
        'sub_work_type',
        'status',
    ];

    
    public function worktype()
    {
        return $this->hasOne(WorkType::class, 'id', 'work_type_id');
    }
}
