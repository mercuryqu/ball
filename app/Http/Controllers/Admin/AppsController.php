<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\WebStatus;
use App\Http\Requests\AppRequest;
use App\Models\App;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class AppsController extends AdminBaseController
{
    /**
     * Define a new resource var
     * @var $app
     */
    protected $app;
    protected $app_logo_save_path;
    protected $app_logos_width;
    protected $app_logos_height;
    protected $app_codes_save_path;
    protected $app_codes_width;
    protected $app_codes_height;
    protected $app_images_save_path;
    protected $app_images_width;
    protected $app_images_height;

    /**
     * Create a new ad_position instance.
     *
     * @param  \App\Models\App  $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->app_logo_save_path = config('custom.app_logos_save_path');
        $this->app_logos_width = config('custom.app_logos_width');
        $this->app_logos_height = config('custom.app_logos_height');
        $this->app_codes_save_path = config('custom.app_codes_save_path');
        $this->app_codes_width = config('custom.app_codes_width');
        $this->app_codes_height = config('custom.app_codes_height');
        $this->app_images_save_path = config('custom.app_images_save_path');
        $this->app_images_width = config('custom.app_images_width');
        $this->app_images_height = config('custom.app_images_height');
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
        $filter_member_name = $request->input('filter_member_name');
        $filter_is_recommended = $request->input('filter_is_recommended');
        $filter_status = $request->input('filter_status');
        
        $apps = $this->app->with('member', 'categories')
            ->filterName($filter_name)
            ->filterMemberName($filter_member_name)
            ->filterStatus($filter_status)
            ->orderByCreatedAtAndId()
            ->paginate();

        return view('admin.apps.index', compact('apps', 'filter_name', 'filter_member_name', 'filter_is_recommended', 'filter_status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.apps.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AppRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AppRequest $request)
    {
        // upload logo_file
        if ($request->hasFile('logo_file')) {
            $image = $request->file('logo_file');
            if (! $image->isValid()) {
                return Redirect::back()
                    ->withInput()
                    ->with('code', WebStatus::IMAGE_UPLOAD_FAILED_CODE)
                    ->with('failure', WebStatus::IMAGE_UPLOAD_FAILED_MESSAGE);
            }
            $full_logo_path = upload_image($image, $this->app_logo_save_path, $this->app_logos_width, $this->app_logos_height);
            $request->merge(['logo' => $full_logo_path]);
        }

        // upload code_file
        if ($request->hasFile('code_file')) {
            $code = $request->file('code_file');
            if (! $code->isValid()) {
                return Redirect::back()
                    ->withInput()
                    ->with('code', WebStatus::IMAGE_UPLOAD_FAILED_CODE)
                    ->with('failure', WebStatus::IMAGE_UPLOAD_FAILED_MESSAGE);
            }
            $full_code_path = upload_image($code, $this->app_codes_save_path, $this->app_codes_width, $this->app_codes_height);
            $request->merge(['code' => $full_code_path]);
        }

        // save app info
        $result = $this->app->create($request->except(['_token', 'categories', 'logo_file', 'code_file', 'images_files']));

        // save app_images info
        $images_array = [];
        if ($request->hasFile('images_files')) {
            $images = $request->file('images_files');
            foreach ($images as $image) {
                if (! $image->isValid()) {
                    return Redirect::back()
                        ->withInput()
                        ->with('code', WebStatus::IMAGE_UPLOAD_FAILED_CODE)
                        ->with('failure', WebStatus::IMAGE_UPLOAD_FAILED_MESSAGE);
                }
                $full_image_path = upload_image($image, $this->app_images_save_path, $this->app_images_width, $this->app_images_height);
                $now_time = Carbon::now();
                $images_array[] = [
                    'app_id' => $result->id,
                    'url' => $full_image_path,
                    'created_at' => $now_time,
                    'updated_at' => $now_time,
                ];
            }
        }

        // insert images url to images table
        if (count($images_array) > 0) {
            \App\Models\Image::insert($images_array);
        }

        // save app_categories info
        $categories = explode(',', $request->input('categories'));
        $result->categories()->attach($categories);

        if (! $result) {
            return Redirect::back()
                ->withInput()
                ->with('code', WebStatus::CREATE_FAILED_CODE)
                ->with('failure', WebStatus::CREATE_FAILED_MESSAGE);
        }

        return Redirect::route('admin.apps.index')
            ->with('code', WebStatus::CREATE_SUCCESS_CODE)
            ->with('success', WebStatus::CREATE_SUCCESS_MESSAGE);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\App  $app
     * @return \Illuminate\Http\Response
     */
    public function show(App $app)
    {
        return view('admin.apps.show', compact('app'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\App  $app
     * @return \Illuminate\Http\Response
     */
    public function edit(App $app)
    {
        return view('admin.apps.edit', compact('app'));
    }

    /**
     * Change the form for index.
     *
     * @param  \App\Models\App  $app
     * @return \Illuminate\Http\Response
     */
    public function change(App $app, Request $request)
    {
        $status = $request->input('status');
        $reasons = json_encode(explode("\r\n", $request->input('reason')));

        $app->status = $status;
        $result = $app->save();

        if (! $result) {
            return Redirect::back()
                ->withInput()
                ->with('code', WebStatus::UPDATE_FAILED_CODE)
                ->with('failure', WebStatus::UPDATE_FAILED_MESSAGE);
        }

        // create change log
        if ($status == 2) {
            $app->appExamineLog()->create([
                    'reason' => $reasons,
                    'status' => 0
                ]);
        }

        return Redirect::route('admin.apps.index')
            ->with('code', WebStatus::UPDATE_SUCCESS_CODE)
            ->with('success', WebStatus::UPDATE_SUCCESS_MESSAGE);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AppRequest  $request
     * @param  \App\Models\App  $app
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AppRequest $request, App $app)
    {
        // upload logo_file
        if ($request->hasFile('logo_file')) {
            $image = $request->file('logo_file');
            if (! $image->isValid()) {
                return Redirect::back()
                    ->withInput()
                    ->with('code', WebStatus::IMAGE_UPLOAD_FAILED_CODE)
                    ->with('failure', WebStatus::IMAGE_UPLOAD_FAILED_CODE);
            }
            $full_logo_path = upload_image($image, $this->app_logo_save_path, $this->app_logos_width, $this->app_logos_height);
            $request->merge(['logo' => $full_logo_path]);
        }

        // upload code_file
        if ($request->hasFile('code_file')) {
            $code = $request->file('code_file');
            if (! $code->isValid()) {
                return Redirect::back()
                    ->withInput()
                    ->with('code', WebStatus::IMAGE_UPLOAD_FAILED_CODE)
                    ->with('failure', WebStatus::IMAGE_UPLOAD_FAILED_CODE);
            }
            $full_code_path = upload_image($code, $this->app_codes_save_path, $this->app_codes_width, $this->app_codes_height);
            $request->merge(['code' => $full_code_path]);
        }

        $result = $app->update($request->except(['_method', '_token', 'previous', 'categories']));

        // save app_images info
        $images_array = [];
        if ($request->hasFile('images_files')) {
            $image_save_folder = config('custom.app_images_save_path');
            $images = $request->file('images_files');
            foreach ($images as $image) {
                if (! $image->isValid()) {
                    return Redirect::back()
                        ->withInput()
                        ->with('code', WebStatus::IMAGE_UPLOAD_FAILED_CODE)
                        ->with('failure', WebStatus::IMAGE_UPLOAD_FAILED_CODE);
                }
                $full_image_path = upload_image($image, $this->app_images_save_path, $this->app_images_width, $this->app_images_height);
                $now_time = Carbon::now();
                $images_array[] = [
                    'app_id' => $app->id,
                    'url' => $full_image_path,
                    'created_at' => $now_time,
                    'updated_at' => $now_time,
                ];
            }
        }

        // insert images url to images table
        if (count($images_array) > 0) {
            \App\Models\Image::where('app_id', $app->id)->delete();
            \App\Models\Image::insert($images_array);
        }

        $categories = collect(explode(',', $request->input('categories')));
        $exists_category_ids = $app->categories->pluck('id');
        $insert_ids = $categories->diff($exists_category_ids);
        $delete_ids = $exists_category_ids->diff($categories);

        // insert new app_ids
        if ($insert_ids->count() > 0) {
            $app->categories()->attach($insert_ids);
        }

        // delete surplus app_ids
        if ($delete_ids->count() > 0) {
            $app->categories()->detach($delete_ids);
        }

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
     * @param App $app
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(App $app)
    {
        $app->delete();
        
        if ($app->trashed()) {
            return Redirect::back()
                ->with('code', WebStatus::DELETE_SUCCESS_CODE)
                ->with('success', WebStatus::DELETE_SUCCESS_MESSAGE);
        }

        return Redirect::back()
            ->with('code', WebStatus::DELETE_FAILED_CODE)
            ->with('failure', WebStatus::DELETE_FAILED_MESSAGE);
    }
}
