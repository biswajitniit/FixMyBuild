<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectStatusChangeLog extends Model
{
    use HasFactory;

    protected $table = 'project_status_change_log';

    protected $fillable = [
        'project_id',
        'action_by_id',
        'action_by_type',
        'status',
        'status_changed_at',
    ];
}
