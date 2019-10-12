<?php

namespace App\Models;

class AppImage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'app_id', 'image_id'
    ];
}
