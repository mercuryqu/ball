<?php

namespace App\Http\Controllers\Admin;

use App\Models\App;
use App\Models\Comment;
use App\Models\Member;
use App\Models\Topic;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends AdminBaseController
{
    /**
     * Define a new resource var
     * @var $app
     * @var $member
     */
    protected $app;
    protected $member;
    protected $comment;
    protected $topic;

    /**
     * Create a new member instance.
     *
     * @param  \App\Models\App  $app
     */
    public function __construct(App $app, Member $member, Comment $comment, Topic $topic)
    {
        $this->app = $app;
        $this->member = $member;
        $this->comment = $comment;
        $this->topic = $topic;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $today_time = Carbon::today();
        $today_apps = $this->app->whereStatus(1)->where('created_at', '>=', $today_time)->count();
        $today_members = $this->member->whereStatus(1)->where('created_at', '>=', $today_time)->count();
        $today_comments = $this->comment->whereStatus(1)->where('created_at', '>=', $today_time)->count();
        $today_topics = $this->topic->whereStatus(1)->where('created_at', '>=', $today_time)->count();

        $all_apps = $this->app->whereStatus(1)->count();
        $all_members = $this->member->whereStatus(1)->count();
        $all_comments = $this->comment->whereStatus(1)->count();
        $all_topics = $this->topic->whereStatus(1)->count();
        $all_view_count = $this->app->sum('view_count');

        $data = [
            'app' => [
                'today_count' => $today_apps,
                'all_count' => $all_apps,
                'today_title' => '今日新增小程序数',
                'all_title' => '总小程序数',
                'color' => 'aqua',
                'icon' => 'bag',
            ],
            'member' => [
                'today_count' => $today_members,
                'all_count' => $all_members,
                'today_title' => '今日新增会员数',
                'all_title' => '总会员数',
                'color' => 'yellow',
                'icon' => 'person-add',
            ],
            'comment' => [
                'today_count' => $today_comments,
                'all_count' => $all_comments,
                'today_title' => '今日新增评论数',
                'all_title' => '总评论数',
                'color' => 'blue',
                'icon' => 'stats-bars',
            ],
            'topic' => [
                'today_count' => $today_topics,
                'all_count' => $all_topics,
                'today_title' => '今日新增专题数',
                'all_title' => '总专题数',
                'color' => 'gray',
                'icon' => 'pie-graph',
            ],
        ];

        return view('admin.home', compact('data', 'all_view_count'));
    }
}
