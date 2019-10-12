<?php

namespace App\Http\Controllers\Wap;

use App\Helpers\Jssdk;
use App\Models\Ad;
use App\Models\AdPosition;
use App\Models\App;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends WapBaseController
{
    /**
     * Define a new resource var
     * @var $category
     * @var $app
     * @var $ad
     */
    protected $category;
    protected $app;
    protected $ad_position;
    protected $ad;

    /**
     * Create a new ad_position instance.
     *
     * @param  \App\Models\Category  $category
     * @param  \App\Models\App  $app
     * @param  \App\Models\AdPosition  $ad_position
     * @param  \App\Models\Ad  $ad
     */
    public function __construct(Category $category, App $app, AdPosition $ad_position, Ad $ad)
    {
        $this->category = $category;
        $this->app = $app;
        $this->ad_position = $ad_position;
        $this->ad = $ad;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Query category's carousels
        $position = $this->ad_position->getAdPositionAndAds(1, 'category_banner', 1);
        $carousels = $position ? $position->ads : collect();

        // Query first level categories
        $first_level_categories = $this->category->getFirstLevelCategories();

        $first_category_app_count = 0;
        $first_category_apps = collect();
        if ($first_level_categories->count() > 0) {
            $first_category_apps = $first_level_categories->first()->apps()->whereStatus(1);;
            $first_category_app_count = $first_category_apps->count();
            $first_category_apps = $first_category_apps->limit(10)->latest('sort')->get();
        }

        // get wechat share config
        $jssdk = new Jssdk();
        $sign_package = $jssdk->getSignPackage();

        return view('wap.categories.index', compact('carousels', 'first_level_categories', 'first_category_apps', 'first_category_app_count', 'sign_package'));
    }

    /**
     * @param Category $category
     */
    public function show(Category $category)
    {
        // get wechat share config
        $jssdk = new Jssdk();
        $sign_package = $jssdk->getSignPackage();
        return view('wap.categories.show', compact('category', 'sign_package'));
    }

    /**
     * @param Request $request
     */
    public function apps(Request $request, Category $category)
    {
        if ($request->isMethod('get')) {
            $per_page = $request->input('per_page', 10);
            $type = $request->input('type');
            $apps = $category->getCategoryApps($per_page);

            if ($type == 'index') {
                return $apps;
            }
            return wap_apps_list($apps);
        }
    }
}
