<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'is_email_verified',
        'phone',
        'customer_or_tradesperson',
        'verify',
        'verification_code',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * @description get the detail associated with the post
     */
    public function customer()
    {
        return $this->hasOne(Customer::class);
    }

    public function estimates()
    {
        return $this->hasMany(Estimate::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @description get the reviews given to a Tradesperson
     */
    public function reviews()
    {
        return $this->hasMany(ProjectReview::class);
    }

    /**
     * @description get the files uploaded by a tradesperson
     */
    public function tradespersonFiles() {
        return $this->hasMany(TradespersonFile::class);
    }

    /**
     * @description get the total number of reviews obtained by a Tradesperson
     */
    // public function totalRatings()
    // {
    //     return $query = ProjectReview::where('tradesperson_id', $this->id)->count();
    // }

    /**
     * @description get the percentage based on workmanship obtained by a Tradesperson
     */
    // public function workmanshipPercentage()
    // {
    //     $query = ProjectReview::where('tradesperson_id', $this->id);

    //     return $query->count() ? (($query->sum('workmanship')/(2 * $query->count())) * 100) : null;
    // }

    /**
     * @description get the percentage based on punctuality obtained by a Tradesperson
     */
    // public function punctualityPercentage()
    // {
    //     $query = ProjectReview::where('tradesperson_id', $this->id);

    //     return $query->count() ? (  $query->sum('punctuality') / $query->count()) * 100 : null;
    // }

    /**
     * @description get the percentage based on tidiness obtained by a Tradesperson
     */
    // public function tidinessPercentage()
    // {
    //     $query = ProjectReview::where('tradesperson_id', $this->id);

    //     return $query->count() ? (  $query->sum('tidiness') / $query->count()) * 100 : null;
    // }

    /**
     * @description get the percentage based on price_accuracy obtained by a Tradesperson
     */
    // public function priceAccuracy()
    // {
    //     $query = ProjectReview::where('tradesperson_id', $this->id);

    //     return $query->count() ? (  $query->sum('price_accuracy') / $query->count()) * 100 : null;
    // }
}
