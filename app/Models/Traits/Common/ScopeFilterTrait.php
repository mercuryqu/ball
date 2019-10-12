<?php

namespace App\Models\Traits\Common;

use App\Models\AdPosition;
use App\Models\App;
use App\Models\Member;

trait ScopeFilterTrait
{
    protected $status_display;
    protected $position_display;
    protected $platform_display;
    protected $is_reply_display;
    protected $jump_type_display;

    /**
     * Filter result of query by name
     * @param  $query Object SQL对象
     * @param  $filter_name string 名称关键词
     * @return  mixed
     */
    public function scopeFilterName($query, $filter_name)
    {
        if (strlen($filter_name) > 0) {
            return $query->where('name', 'like', '%' . $filter_name . '%');
        }
        return $query;
    }

    /**
     * Filter result of query by title
     * @param  $query Object SQL对象
     * @param  $filter_title string 名称关键词
     * @return  mixed
     */
    public function scopeFilterTitle($query, $filter_title)
    {
        if (strlen($filter_title) > 0) {
            return $query->where('title', 'like', '%' . $filter_title . '%');
        }
        return $query;
    }

    /**
     * Filter result of query by body
     * @param  $query Object SQL对象
     * @param  $filter_body string 内容关键词
     * @return  mixed
     */
    public function scopeFilterBody($query, $filter_body)
    {
        if (strlen($filter_body) > 0) {
            return $query->where('body', 'like', '%' . $filter_body . '%');
        }
        return $query;
    }

    /**
     * Filter result of query by keyword
     * @param  $query Object SQL对象
     * @param  $filter_keyword string 关键词名称
     * @return  mixed
     */
    public function scopeFilterKeyword($query, $filter_keyword)
    {
        if (strlen($filter_keyword) > 0) {
            return $query->where('keyword', 'like', '%' . $filter_keyword . '%');
        }
        return $query;
    }

    /**
     * Filter result of query by status
     * @param $query
     * @param $filter_status integer 状态
     * @return mixed
     */
    public function scopeFilterStatus($query, $filter_status)
    {
        if (strlen($filter_status) > 0 && array_key_exists($filter_status, $this->status_display)) {
            return $query->where('status', $filter_status);
        }
        return $query;
    }

    /**
     * Filter result of query by id
     * @param $query
     * @param $filter_id integer 主键ID
     * @return mixed
     */
    public function scopeFilterId($query, $filter_id)
    {
        if (strlen($filter_id) > 0 && is_int($filter_id)) {
            return $query->where('id', $filter_id);
        }
        return $query;
    }

    /**
     * Filter result of query by level
     * @param $query
     * @param $filter_level integer 层级
     * @return mixed
     */
    public function scopeFilterLevel($query, $filter_level)
    {
        if (strlen($filter_level) > 0 && array_key_exists($filter_level, $this->level_display)) {
            return $query->where('level', $filter_level);
        }
        return $query;
    }

    /**
     * Filter result of query by position
     * @param  $query Object SQL对象
     * @param  $filter_position string 位置标识
     * @return  mixed
     */
    public function scopeFilterPosition($query, $filter_position)
    {
        if (strlen($filter_position) > 0 && array_key_exists($filter_position, $this->position_display)) {
            return $query->where('position', $filter_position);
        }
        return $query;
    }

    /**
     * Filter result of query by platform
     * @param  $query Object SQL对象
     * @param  $filter_platform integer 位置标识
     * @return  mixed
     */
    public function scopeFilterPlatform($query, $filter_platform)
    {
        if (strlen($filter_platform) > 0 && array_key_exists($filter_platform, $this->platform_display)) {
            return $query->where('platform', $filter_platform);
        }
        return $query;
    }

    /**
     * Filter result of query by member name
     * @param  $query Object SQL对象
     * @param  $filter_member_name string 会员名称关键词
     * @return mixed
     */
    public function scopeFilterMemberName($query, $filter_member_name)
    {
        if (strlen($filter_member_name) > 0) {
            $member_ids = Member::where('name', 'like', '%' . $filter_member_name . '%')->pluck('id');
            return $query->whereIn('member_id', $member_ids);
        }
        return $query;
    }

    /**
     * Filter result of query by is_reply
     * @param $query
     * @param $filter_is_reply integer 是否回复
     * @return mixed
     */
    public function scopeFilterIsReply($query, $filter_is_reply)
    {
        if (strlen($filter_is_reply) > 0 && array_key_exists($filter_is_reply, $this->is_reply_display)) {
            return $query->where('is_reply', $filter_is_reply);
        }
        return $query;
    }

    /**
     * Filter result of query by type
     * @param $query
     * @param $filter_type integer 类型
     * @return mixed
     */
    public function scopeFilterType($query, $filter_type)
    {
        if (strlen($filter_type) > 0 && array_key_exists($filter_type, $this->type_display)) {
            return $query->where('type', $filter_type);
        }
        return $query;
    }

    /**
     * Filter result of query by jump_type
     * @param $query
     * @param $filter_jump_type integer 类型
     * @return mixed
     */
    public function scopeFilterJumpType($query, $filter_jump_type)
    {
        if (strlen($filter_jump_type) > 0 && array_key_exists($filter_jump_type, $this->jump_type_display)) {
            return $query->where('jump_type', $filter_jump_type);
        }
        return $query;
    }

    /**
     * Filter result of query by username
     * @param  $query Object SQL对象
     * @param  $filter_username string 名称关键词
     * @return  mixed
     */
    public function scopeFilterUserName($query, $filter_username)
    {
        if (strlen($filter_username) > 0) {
            return $query->where('username', 'like', '%' . $filter_username . '%');
        }
        return $query;
    }

    /**
     * Filter result of query by telephone
     * @param  $query Object SQL对象
     * @param  $filter_telephone string 名称关键词
     * @return  mixed
     */
    public function scopeFilterTelephone($query, $filter_telephone)
    {
        if (strlen($filter_telephone) > 0) {
            return $query->where('telephone', 'like', '%' . $filter_telephone . '%');
        }
        return $query;
    }

    /**
     * Filter result of query by email
     * @param  $query Object SQL对象
     * @param  $filter_email string 名称关键词
     * @return  mixed
     */
    public function scopeFilterEmail($query, $filter_email)
    {
        if (strlen($filter_email) > 0) {
            return $query->where('email', 'like', '%' . $filter_email . '%');
        }
        return $query;
    }

    /**
     * Filter result of query by app name
     * @param  $query Object SQL对象
     * @param  $filter_app_name string 小程序名称关键词
     * @return mixed
     */
    public function scopeFilterAppName($query, $filter_app_name)
    {
        if (strlen($filter_app_name) > 0) {
            $app_ids = App::where('name', 'like', '%' . $filter_app_name . '%')->pluck('id');
            return $query->whereIn('app_id', $app_ids);
        }
        return $query;
    }

    /**
     * Filter result of query by code
     * @param  $query Object SQL对象
     * @param  $filter_code string 名称关键词
     * @return  mixed
     */
    public function scopeFilterCode($query, $filter_code)
    {
        if (strlen($filter_code) > 0) {
            return $query->where('code', $filter_code);
        }
        return $query;
    }

    /**
     * Filter result of query by ad position name
     * @param  $query Object SQL对象
     * @param  $filter_ad_position_name string 广告名称关键词
     * @return mixed
     */
    public function scopeFilterAdPositionName($query, $filter_ad_position_name)
    {
        if (strlen($filter_ad_position_name) > 0) {
            $app_ids = AdPosition::where('name', 'like', '%' . $filter_ad_position_name . '%')->pluck('id');
            return $query->whereIn('ad_position_id', $app_ids);
        }
        return $query;
    }

    /**
     * Filter result of query by ad_position_id
     * @param $query
     * @param $filter_ad_position_id integer 广告位ID
     * @return mixed
     */
    public function scopeFilterAdPositionId($query, $filter_ad_position_id)
    {
        if (strlen($filter_ad_position_id) > 0) {
            return $query->where('ad_position_id', $filter_ad_position_id);
        }
        return $query;
    }

    /**
     * Filter result of query by app_id
     * @param $query
     * @param $filter_app_id integer 小程序ID
     * @return mixed
     */
    public function scopeFilterAppId($query, $filter_app_id)
    {
        if (strlen($filter_app_id) > 0) {
            return $query->where('app_id', $filter_app_id);
        }
        return $query;
    }
}