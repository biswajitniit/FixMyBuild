<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Cms extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['cms_pagename', 'cms_heading', 'cms_description', 'status'];
}
