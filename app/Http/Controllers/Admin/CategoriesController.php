<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\WebStatus;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoriesController extends AdminBaseController
{
    /**
     * Define a new resource var
     * @var $category
     */
    protected $category;
    protected $category_icons_save_path;
    protected $category_icons_width;
    protected $category_icons_height;

    /**
     * Create a new category instance.
     *
     * @param  \App\Models\Category  $category
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
        $this->category_icons_save_path = config('custom.category_icons_save_path');
        $this->category_icons_width = config('custom.category_icons_width');
        $this->category_icons_height = config('custom.category_icons_height');
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
        $filter_parent_category_id = $request->input('filter_parent_category_id');
        $filter_parent_category_name = $request->input('filter_parent_category_name');
        $filter_level = $request->input('filter_level');

        $categories = $this->category
            ->with('parentCategory')
            ->filterName($filter_name)
            ->filterParentCategoryId($filter_parent_category_id)
            ->filterParentCategoryName($filter_parent_category_name)
            ->filterLevel($filter_level)
            ->latest('sort')
            ->orderByCreatedAtAndId()
            ->paginate();

        return view('admin.categories.index', compact('categories', 'filter_name', 'filter_parent_category_name', 'filter_level'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        // upload logo_file
        if ($request->hasFile('icon_file')) {
            $icon = $request->file('icon_file');
            if (! $icon->isValid()) {
                return Redirect::back()
                    ->withInput()
                    ->with('code', WebStatus::IMAGE_UPLOAD_FAILED_CODE)
                    ->with('failure', WebStatus::IMAGE_UPLOAD_FAILED_MESSAGE);
            }
            $full_icon_path = upload_image($icon, $this->category_icons_save_path, $this->category_icons_width, $this->category_icons_height);
            $request->merge(['icon' => $full_icon_path]);
        }

        // if this category's parent_category_id is zero then level is 1
        $parent_category_id = $request->input('parent_category_id');
        $request->merge(['level' => 1]);

        // if this category's parent_category_id greater than zero then level is parent category's level increase 1
        if ($parent_category_id > 0) {
            $parent_category = Category::find($parent_category_id);
            if (! $parent_category) {
                return Redirect::back()
                    ->withInput()
                    ->withErrors(['parent_category_id' => '上级分类ID不存在。']);
            }

            $level = $parent_category->level + 1;
            $request->merge(['level' => $level]);
        }

        // calculate max sort number
        $max_sort = $this->category->max('sort');
        $request->merge(['sort' => $max_sort + 1]);

        $result = $this->category->create($request->except('_token', 'icon_file'));

        if (! $result) {
            return Redirect::back()
                ->withInput()
                ->with('code', WebStatus::CREATE_FAILED_CODE)
                ->with('failure', WebStatus::CREATE_FAILED_MESSAGE);
        }

        return Redirect::route('admin.categories.index')
            ->with('code', WebStatus::CREATE_SUCCESS_CODE)
            ->with('success', WebStatus::CREATE_SUCCESS_MESSAGE);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        // upload logo_file
        if ($request->hasFile('icon_file')) {
            $icon = $request->file('icon_file');
            if (! $icon->isValid()) {
                return Redirect::back()
                    ->withInput()
                    ->with('code', WebStatus::IMAGE_UPLOAD_FAILED_CODE)
                    ->with('failure', WebStatus::IMAGE_UPLOAD_FAILED_MESSAGE);
            }
            $full_icon_path = upload_image($icon, $this->category_icons_save_path, $this->category_icons_width, $this->category_icons_height);
            $request->merge(['icon' => $full_icon_path]);
        }

        $result = $category->update($request->except(['_method', '_token', 'previous']));

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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        if (! $category->trashed()) {
            return Redirect::back()
                ->with('code', WebStatus::DELETE_FAILED_CODE)
                ->with('failure', WebStatus::DELETE_FAILED_MESSAGE);
        }

        return Redirect::back()
            ->with('code', WebStatus::DELETE_SUCCESS_CODE)
            ->with('success', WebStatus::DELETE_SUCCESS_MESSAGE);
    }
}
