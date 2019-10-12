<?php

namespace App\Http\Controllers\Wap;

use App\Helpers\Jssdk;
use App\Models\App;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicsController extends WapBaseController
{
    /**
     * Define a new resource var
     * @var $topic
     */
    protected $topic;

    /**
     * Create a new ad_position instance.
     *
     * @param  \App\Models\App  $topic
     */
    public function __construct(App $topic)
    {
        $this->app = $topic;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function data(Request $request)
    {
        $name = $request->input('name');
        $per_page = $request->input('per_page', 8);
        $topics = $this->app->FilterName($name)
            ->orderBy('star', 'desc')
            ->orderBy('view_count', 'desc')
            ->orderByCreatedAtAndId()
            ->simplePaginate($per_page);

        return response()->jsonp($request->input('callback'), $topics, 200, ['Access-Control-Allow-Origin' => 'true']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic)
    {
        $apps = $topic->apps()->where('status', 1)->get();
        // get wechat share config
        $jssdk = new Jssdk();
        $sign_package = $jssdk->getSignPackage();
        return view('wap.topics.show', compact('topic', 'apps', 'sign_package'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show_pull(Topic $topic)
    {
        $apps = $topic->apps()->where('status', 1)->latest('sort')->get();
        // get wechat share config
        $jssdk = new Jssdk();
        $sign_package = $jssdk->getSignPackage();
        return view('wap.topics.show-pull', compact('topic', 'apps', 'sign_package'));
    }
}
