<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'project_id',
        'tradesperson_id',
        'punctuality',
        'workmanship',
        'tidiness',
        'price_accuracy',
        'detailed_review',
        'description',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @description get the Tradesperson to whom the review is given
     */
    public function tradesperson() {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * @description get the project on which the review is given
     */
    public function project() {
        return $this->belongsTo(Project::class);
    }
}
