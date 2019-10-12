<?php

namespace App\Models;

use App\Models\Traits\MemberTrait;

class Member extends Model
{
    use MemberTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'telephone', 'email', 'avatar', 'status'
    ];

    /**
     * Define status field format array
     * @var array
     */
    public $status_display = [
        '0' => '待审核',
        '1' => '正常',
        '2' => '禁用',
    ];
}
