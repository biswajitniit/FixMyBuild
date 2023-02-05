<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkType extends Model
{
    use HasFactory;
    protected $fillable = [
        'work_type',
        'status',
    ];

    
    public function subworktypes()
    {
        return $this->hasMany(SubWorkType::class, 'work_type_id', 'id');
    }
}
