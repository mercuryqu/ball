<?php

namespace App\Models\Traits\Common;

use App\Models\Ad;
use App\Models\AdPosition;
use App\Models\App;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Member;
use App\Models\Module;
use App\Models\Reply;
use App\Models\AppTopic;
use App\Models\Topic;
use App\Models\User;

trait RelationshipTrait
{
    /**
     * Relate many categories table
     * @relationship  item:categories = N:N
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    /**
     * Relate many members table
     * @relationship  item:members = N:1
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    /**
     * Relate many images table
     * @relationship  item:images = 1:N
     * @return  \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    /**
     * Relate many ad table
     * @relationship  item:ad = 1:N
     * @return  \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function ads()
    {
        return $this->hasMany(Ad::class);
    }

    /**
     * Relate app table
     * @relationship  item:app = N:1
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function app()
    {
        return $this->belongsTo(App::class);
    }

    /**
     * Relate category table
     * @relationship  item:app = N:1
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relate topic table
     * @relationship  item:app = N:1
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    /**
     * Relate many apps table
     * @relationship  item:app = 1:N
     * @return  \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function apps()
    {
        return $this->belongsToMany(App::class)->withTimestamps();
    }

    /**
     * Relate user table
     * @relationship  item:user = N:1
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relate comment table
     * @relationship  item:comment = 1:1
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    /**
     * Relate comments table
     * @relationship  item:comments = 1:N
     * @return  \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Relate reply table
     * @relationship  item:reply = 1:1
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reply()
    {
        return $this->hasOne(Reply::class);
    }

    /**
     * Relate ad position table
     * @relationship  item:position = N:1
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function adPosition()
    {
        return $this->belongsTo(AdPosition::class);
    }

    /**
     * Relate many modules table
     * @relationship  item:modules = N:1
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}