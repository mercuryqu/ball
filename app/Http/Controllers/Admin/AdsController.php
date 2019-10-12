<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\WebStatus;
use App\Http\Requests\AdRequest;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdsController extends AdminBaseController
{
    /**
     * Define a new resource var
     * @var $ad
     */
    protected $ad;
    protected $ad_images_save_path;
    protected $ad_images_width;
    protected $ad_images_height;

    /**
     * Create a new ad instance.
     *
     * @param  \App\Models\Ad  $ad
     */
    public function __construct(Ad $ad)
    {
        $this->ad = $ad;
        $this->ad_images_save_path = config('custom.ad_images_save_path');
        $this->ad_images_width = config('custom.ad_images_width');
        $this->ad_images_height = config('custom.ad_images_height');

    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter_name = $request->input('filter_name');
        $filter_ad_position_id = $request->input('filter_ad_position_id');
        $filter_ad_position_name = $request->input('filter_ad_position_name');
        $filter_jump_type = $request->input('filter_jump_type');
        $filter_platform = $request->input('filter_platform');
        $filter_status = $request->input('filter_status');

        $ads = $this->ad
            ->with('adPosition')
            ->filterName($filter_name)
            ->filterAdPositionId($filter_ad_position_id)
            ->filterAdPositionName($filter_ad_position_name)
            ->filterJumpType($filter_jump_type)
            ->filterPlatform($filter_platform)
            ->filterStatus($filter_status)
            ->latest('sort')
            ->orderByCreatedAtAndId()
            ->paginate();

        return view('admin.ads.index', compact('ads', 'filter_name', 'filter_ad_position_id', 'filter_ad_position_name', 'filter_jump_type', 'filter_platform', 'filter_status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AdRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdRequest $request)
    {
        // upload image_file
        if ($request->hasFile('image_file')) {
            $image = $request->file('image_file');
            if (! $image->isValid()) {
                return Redirect::back()
                    ->withInput()
                    ->with('code', WebStatus::IMAGE_UPLOAD_FAILED_CODE)
                    ->with('failure', WebStatus::IMAGE_UPLOAD_FAILED_MESSAGE);
            }
            $full_image_path = upload_image($image, $this->ad_images_save_path, $this->ad_images_width, $this->ad_images_height);
            $request->merge(['image_url' => $full_image_path]);
        }

        $result = $this->ad->create($request->except('_token'));

        if (! $result) {
            return Redirect::back()
                ->withInput()
                ->with('code', WebStatus::CREATE_FAILED_CODE)
                ->with('failure', WebStatus::CREATE_FAILED_MESSAGE);
        }

        return Redirect::route('admin.ads.index')
            ->with('code', WebStatus::CREATE_SUCCESS_CODE)
            ->with('success', WebStatus::CREATE_SUCCESS_MESSAGE);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function show(Ad $ad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function edit(Ad $ad)
    {
        return view('admin.ads.edit', compact('ad'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AdRequest  $request
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function update(AdRequest $request, Ad $ad)
    {
        // upload image_file
        if ($request->hasFile('image_file')) {
            $image = $request->file('image_file');
            if (! $image->isValid()) {
                return Redirect::back()
                    ->withInput()
                    ->with('code', WebStatus::IMAGE_UPLOAD_FAILED_CODE)
                    ->with('failure', WebStatus::IMAGE_UPLOAD_FAILED_MESSAGE);
            }
            $image_save_folder = config('custom.ad_images_save_path');
            $full_image_path = upload_image($image, $image_save_folder, 750, 500);
            $request->merge(['image_url' => $full_image_path]);
        }

        $result = $ad->update($request->except(['_method', '_token', 'previous']));

        if (! $result) {
            return Redirect::back()
                ->withInput()
                ->with('code', WebStatus::UPDATE_FAILED_CODE)
                ->with('failure', WebStatus::UPDATE_FAILED_MESSAGE);
        }

        return Redirect::to($request->previous)
            ->with('code', WebStatus::UPDATE_SUCCESS_CODE)
            ->with('success', WebStatus::UPDATE_SUCCESS_MESSAGE);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ad  $ad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ad $ad)
    {
        $ad->delete();

        if (! $ad->trashed()) {
            return Redirect::back()
                ->with('code', WebStatus::DELETE_FAILED_CODE)
                ->with('failure', WebStatus::DELETE_FAILED_MESSAGE);
        }

        return Redirect::back()
            ->with('code', WebStatus::DELETE_SUCCESS_CODE)
            ->with('success', WebStatus::DELETE_SUCCESS_MESSAGE);
    }
}
