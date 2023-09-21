<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estimate extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'describe_mode',
        'unable_to_describe_type',
        'more_info',
        'do_not_undertake_project_type',
        'do_not_cover_location',
        'covers_customers_all_needs',
        'payment_required_upfront',
        'apply_vat',
        'contingency',
        'initial_payment',
        'initial_payment_type',
        'project_start_date',
        'project_start_date_type',
        'project_awarded',
        'total_time',
        'total_time_type',
        'terms_and_conditions',
        'project_id',
        'tradesperson_id',
        'status',
    ];

    public function tradesperson()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function files () {
        return $this->hasMany(ProjectEstimateFile::class);
    }

}
