<?php

namespace App\Models;

class Image extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'app_id', 'url'
    ];
}
