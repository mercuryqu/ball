<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\WebStatus;
use App\Http\Requests\AdPositionRequest;
use App\Models\AdPosition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdPositionsController extends AdminBaseController
{
    /**
     * Define a new resource var
     * @var $ad_position
     */
    protected $ad_position;

    /**
     * Create a new ad_position instance.
     *
     * @param  \App\Models\AdPosition  $ad_position
     */
    public function __construct(AdPosition $ad_position)
    {
        $this->ad_position = $ad_position;
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
        $filter_id = $request->input('filter_id');
        $filter_position = $request->input('filter_position');
        $filter_platform = $request->input('filter_platform');
        $filter_status = $request->input('filter_status');

        $ad_positions = $this->ad_position
            ->filterId($filter_id)
            ->filterName($filter_name)
            ->filterPosition($filter_position)
            ->filterPlatform($filter_platform)
            ->filterStatus($filter_status)
            ->orderByCreatedAtAndId()
            ->paginate();

        return view('admin.ad_positions.index', compact('ad_positions', 'filter_id', 'filter_name', 'filter_position', 'filter_platform', 'filter_status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ad_positions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AdPositionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdPositionRequest $request)
    {
        $result = $this->ad_position->create($request->except('_token'));

        if (! $result) {
            return Redirect::back()
                ->withInput()
                ->with('code', WebStatus::CREATE_FAILED_CODE)
                ->with('failure', WebStatus::CREATE_FAILED_MESSAGE);
        }

        return Redirect::route('admin.ad_positions.index')
            ->with('code', WebStatus::CREATE_SUCCESS_CODE)
            ->with('success', WebStatus::CREATE_SUCCESS_MESSAGE);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdPosition  $ad_position
     * @return \Illuminate\Http\Response
     */
    public function show(AdPosition $ad_position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdPosition  $ad_position
     * @return \Illuminate\Http\Response
     */
    public function edit(AdPosition $ad_position)
    {
        return view('admin.ad_positions.edit', compact('ad_position'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AdPositionRequest  $request
     * @param  \App\Models\AdPosition  $ad_position
     * @return \Illuminate\Http\Response
     */
    public function update(AdPositionRequest $request, AdPosition $ad_position)
    {
        $result = $ad_position->update($request->except(['_method', '_token', 'previous']));

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
     * @param  \App\Models\AdPosition  $ad_position
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdPosition $ad_position)
    {
        $ad_position->delete();

        if (! $ad_position->trashed()) {
            return Redirect::back()
                ->with('code', WebStatus::DELETE_FAILED_CODE)
                ->with('failure', WebStatus::DELETE_FAILED_MESSAGE);
        }

        return Redirect::back()
            ->with('code', WebStatus::DELETE_SUCCESS_CODE)
            ->with('success', WebStatus::DELETE_SUCCESS_MESSAGE);
    }
}
