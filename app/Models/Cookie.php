<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Justijndepover\CookieConsent\Concerns\InteractsWithCookies; // add this line

class Cookie extends Model
{
    use InteractsWithCookies;

}
