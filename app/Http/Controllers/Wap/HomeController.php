<?php

namespace App\Http\Controllers\Wap;

use App\Helpers\Jssdk;
use App\Models\App;
use App\Models\Module;
use App\Models\Topic;
use Illuminate\Http\Request;

class HomeController extends WapBaseController
{
    /**
     * Define a new resource var
     */
    protected $module;
    protected $home_module_per_page;

    /**
     * Create a new ad_position instance.
     *
     * @param  \App\Models\Module  $module
     */
    public function __construct(Module $module)
    {
        $this->module = $module;
        $this->home_module_per_page = get_setting_value_by_key('wap_home_module_per_page');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get wechat share config
        $jssdk = new Jssdk();
        $sign_package = $jssdk->getSignPackage();
        return view('wap.home', compact('sign_package'));
    }

    /**
     * Display a modules listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function modules(Request $request)
    {
        $per_page = $request->input('per_page', $this->home_module_per_page);
        $modules = $this->module
            ->getModules()
            ->latest('sort')
            ->paginate($per_page);

        return wap_home_modules($modules);
    }

    /**
     * Display a hot listing of the resource.
     *
     * @param  \App\Models\Module  $module
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function moduleApps(Request $request, Module $module)
    {
        if ($request->isMethod('get')) {
            $per_page = $request->input('per_page', 8);

            $apps = $module->getModuleApps()
                ->paginate($per_page);

            return wap_apps_list($apps);
        }
    }
}
