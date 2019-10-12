<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\WebStatus;
use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SettingsController extends AdminBaseController
{
    /**
     * Define a new resource var
     * @var $setting
     */
    protected $setting;
    protected $filter_platform_config;

    /**
     * Create a new category instance.
     *
     * @param  \App\Models\Setting  $setting
     */
    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
        $this->filter_platform_config = [
            'pc' => [
                'url' => route('admin.settings.index'),
                'title' => 'PC系统设置',
                'fa' => 'tv'
            ],
            'wap' => [
                'url' => route('admin.settings.index', ['filter_platform' => 2]),
                'title' => 'WAP系统设置',
                'fa' => 'tv'
            ],
            'api' => [
                'url' => route('admin.settings.index', ['filter_platform' => 3]),
                'title' => 'API系统设置',
                'fa' => 'tv'
            ],
            'global' => [
                'url' => route('admin.settings.index', ['filter_platform' => 0]),
                'title' => '全局系统设置',
                'fa' => 'tv'
            ],
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter_platform = $request->input('filter_platform', 1);
        $settings = $this->setting
            ->filterPlatform($filter_platform)
            ->oldest()
            ->get();

        $filter_platform_configs = $this->filter_platform_config;
        return view('admin.settings.index', compact('settings', 'filter_platform_configs', 'filter_platform'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.settings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SettingRequest $request)
    {
        $result = $this->setting->create($request->except('_token'));

        if (! $result) {
            return Redirect::back()
                ->withInput()
                ->with('code', WebStatus::CREATE_FAILED_CODE)
                ->with('failure', WebStatus::CREATE_FAILED_MESSAGE);
        }

        return Redirect::route('admin.settings.index')
            ->with('code', WebStatus::CREATE_SUCCESS_CODE)
            ->with('success', WebStatus::CREATE_SUCCESS_MESSAGE);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(SettingRequest $request, Setting $setting)
    {
        $id = $request->input('id');
        $value = $request->input('value');

        $update_data = array_combine($id, $value);

        foreach($update_data as $key=>$item) {
            $setting_obj = $setting->findOrFail($key);
            $setting_obj->value = $item;
            $setting_obj->save();
        }

        return Redirect::back()
            ->with('code', WebStatus::UPDATE_SUCCESS_CODE)
            ->with('success', WebStatus::UPDATE_SUCCESS_MESSAGE);
    }
}
