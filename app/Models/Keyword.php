<?php

namespace App\Models;

use App\Models\Traits\KeywordTrait;

class Keyword extends Model
{
    use KeywordTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'sort', 'times', 'status'
    ];

    /**
     * Define status field format array
     * @var array
     */
    public $status_display = [
        '0' => '禁用',
        '1' => '正常',
    ];
}
