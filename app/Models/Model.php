<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\Common\OrderByTrait;
use App\Models\Traits\Common\GetAttributeTrait;
use App\Models\Traits\Common\SetAttributeTrait;
use App\Models\Traits\Common\ScopeFilterTrait;
use App\Models\Traits\Common\RelationshipTrait;

class Model extends EloquentModel
{
    use OrderByTrait,GetAttributeTrait,SetAttributeTrait,ScopeFilterTrait,RelationshipTrait,SoftDeletes;

    protected $dates = ['deleted_at'];      // 软删除填充时间字段

    protected $unknown = '未知';
}
