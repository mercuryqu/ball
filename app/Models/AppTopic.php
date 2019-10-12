<?php

namespace App\Models;

class AppTopic extends Model
{
    protected $table = 'app_topic';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'app_id', 'topic_id', 'sort'
    ];

    /**
     * Filter result of query by topic_id
     * @param $query
     * @param $filter_topic_id integer 专题ID
     * @return mixed
     */
    public function scopeFilterTopicId($query, $filter_topic_id)
    {
        if (strlen($filter_topic_id) > 0) {
            return $query->where('topic_id', $filter_topic_id);
        }
        return $query;
    }

    /**
     * Filter result of query by ad topic name
     * @param  $query Object SQL对象
     * @param  $filter_topic_name string 专题名称关键词
     * @return mixed
     */
    public function scopeFilterTopicName($query, $filter_topic_name)
    {
        if (strlen($filter_topic_name) > 0) {
            $topic_ids = Topic::where('name', 'like', '%' . $filter_topic_name . '%')->pluck('id');
            return $query->whereIn('topic_id', $topic_ids);
        }
        return $query;
    }
}
