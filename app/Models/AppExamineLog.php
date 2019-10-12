<?php

namespace App\Models;

class AppExamineLog extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'app_id', 'reason', 'status'
    ];
}
