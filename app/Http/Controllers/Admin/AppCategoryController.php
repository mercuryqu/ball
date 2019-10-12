<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\WebStatus;
use App\Models\AppCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AppCategoryController extends AdminBaseController
{
    /**
     * Define a new resource var
     * @var $app_category
     */
    protected $app_category;

    /**
     * Create a new member instance.
     *
     * @param  \App\Models\AppCategory  $app_category
     */
    public function __construct(AppCategory $app_category)
    {
        $this->app_category = $app_category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter_app_id = $request->input('filter_app_id');
        $filter_category_id = $request->input('filter_category_id');
        $filter_app_name = $request->input('filter_app_name');
        $filter_category_name = $request->input('filter_category_name');
        $app_categories = $this->app_category
            ->with(['app', 'category'])
            ->filterAppId($filter_app_id)
            ->filterCategoryId($filter_category_id)
            ->filterAppName($filter_app_name)
            ->filterCategoryName($filter_category_name)
            ->latest('sort')
            ->orderByCreatedAtAndId()
            ->paginate();

        return view('admin.app_category.index', compact('app_categories', 'filter_app_id', 'filter_category_id', 'filter_app_name', 'filter_category_name'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppCategory $app_category)
    {
        $app_category->delete();

        if (! $app_category->trashed()) {
            return Redirect::back()
                ->with('code', WebStatus::DELETE_FAILED_CODE)
                ->with('failure', WebStatus::DELETE_FAILED_MESSAGE);
        }

        return Redirect::back()
            ->with('code', WebStatus::DELETE_SUCCESS_CODE)
            ->with('success', WebStatus::DELETE_SUCCESS_MESSAGE);
    }
}
