<?php

namespace App\Models\Traits\Common;

trait GetAttributeTrait
{
    protected $status_display;
    protected $position_display;
    protected $platform_display;
    protected $is_reply_display;
    protected $type_display;
    protected $level_display;
    protected $jump_type_display;

    /**
     * Format status field from tinyInt to string
     * @relationship  before:after = tinyInt:string
     * @return  mixed
     */
    public function getStatusDisplayAttribute()
    {
        if (isset($this->status_display[$this->attributes['status']])) {
            return $this->status_display[$this->attributes['status']];
        }
        return $this->unknown;
    }

    /**
     * Format level field from tinyInt to string
     * @relationship  before:after = tinyInt:string
     * @return  mixed
     */
    public function getLevelDisplayAttribute()
    {
        if (isset($this->level_display[$this->attributes['level']])) {
            return $this->level_display[$this->attributes['level']];
        }
        return $this->unknown;
    }

    /**
     * Format position field from tinyInt to string
     * @relationship  before:after = tinyInt:string
     * @return  mixed
     */
    public function getPositionDisplayAttribute()
    {
        if (isset($this->position_display[$this->attributes['position']])) {
            return $this->position_display[$this->attributes['position']];
        }
        return $this->unknown;
    }

    /**
     * Format platform field from tinyInt to string
     * @relationship  before:after = tinyInt:string
     * @return  mixed
     */
    public function getPlatformDisplayAttribute()
    {
        if (isset($this->platform_display[$this->attributes['platform']])) {
            return $this->platform_display[$this->attributes['platform']];
        }
        return $this->unknown;
    }

    /**
     * Format jump_type field from tinyInt to string
     * @relationship  before:after = tinyInt:string
     * @return  mixed
     */
    public function getJumpTypeDisplayAttribute()
    {
        if (isset($this->jump_type_display[$this->attributes['jump_type']])) {
            return $this->jump_type_display[$this->attributes['jump_type']];
        }
        return $this->unknown;
    }

    /**
     * Format status field from tinyInt to string
     * @relationship  before:after = tinyInt:string
     * @return  mixed
     */
    public function getIsReplyDisplayAttribute()
    {
        if (isset($this->is_reply_display[$this->attributes['is_reply']])) {
            return $this->is_reply_display[$this->attributes['is_reply']];
        }
        return $this->unknown;
    }

    /**
     * Format type field from tinyInt to string
     * @relationship  before:after = tinyInt:string
     * @return  mixed
     */
    public function getTypeDisplayAttribute()
    {
        if (isset($this->type_display[$this->attributes['type']])) {
            return $this->type_display[$this->attributes['type']];
        }
        return $this->unknown;
    }

}