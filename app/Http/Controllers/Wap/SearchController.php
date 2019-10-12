<?php

namespace App\Http\Controllers\Wap;

use App\Helpers\Jssdk;
use App\Models\App;
use App\Models\Keyword;
use Illuminate\Http\Request;

class SearchController extends WapBaseController
{
    /**
     * Define a new resource var
     * @var $app
     * @var $keyword
     */
    protected $app;
    protected $keyword;

    /**
     * Create a new ad_position instance.
     *
     * @param  \App\Models\App  $app
     * @param  \App\Models\Keyword  $keyword
     */
    public function __construct(App $app, Keyword $keyword)
    {
        $this->app = $app;
        $this->keyword = $keyword;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keywords = $this->keyword
                        ->getKeywords($limit = 5)
                        ->get();

        // get wechat share config
        $jssdk = new Jssdk();
        $sign_package = $jssdk->getSignPackage();
        return view('wap.search.index', compact('keywords', 'sign_package'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function data(Request $request)
    {
        $keyword = $request->input('keyword');
        $per_page = $request->input('per_page', 8);
        $apps = $this->app
            ->FilterNameAndKeyword($keyword)
            ->whereStatus(1)
            ->latest('star')
            ->latest('view_count')
            ->simplePaginate($per_page);

        return wap_apps_list($apps);
    }
}
