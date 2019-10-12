<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\WebStatus;
use App\Http\Requests\TopicRequest;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TopicsController extends AdminBaseController
{
    /**
     * Define a new resource var
     * @var $topic
     */
    protected $topic;

    /**
     * Create a new topic instance.
     *
     * @param  \App\Models\Topic  $topic
     */
    public function __construct(Topic $topic)
    {
        $this->topic = $topic;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter_title = $request->input('filter_title');
        $filter_status = $request->input('filter_status');
        
        $topics = $this->topic
            ->filterTitle($filter_title)
            ->filterStatus($filter_status)
            ->orderByCreatedAtAndId()
            ->paginate();
        
        return view('admin.topics.index', compact('topics', 'filter_title', 'filter_status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.topics.create');
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param  \App\Http\Requests\TopicRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TopicRequest $request)
    {
        // upload logo_file
        if ($request->hasFile('banner_file')) {
            $image = $request->file('banner_file');
            if (! $image->isValid()) {
                return Redirect::back()
                    ->withInput()
                    ->with('code', WebStatus::IMAGE_UPLOAD_FAILED_CODE)
                    ->with('failure', WebStatus::IMAGE_UPLOAD_FAILED_CODE);
            }
            $banner_save_folder = config('custom.topic_banners_save_path');
            $full_banner_path = upload_image($image, $banner_save_folder, 670, 827);
            $request->merge(['banner' => $full_banner_path]);
        }

        $request->merge(['body' => htmlspecialchars_decode($request->body)]);
        $result = $this->topic->create($request->except(['_token', 'app_ids', 'banner_file']));
        $app_ids = explode(',', $request->input('app_ids'));
        $result->apps()->attach($app_ids);
        
        if (! $result) {
            return Redirect::back()
                ->withInput()
                ->with('code', WebStatus::CREATE_FAILED_CODE)
                ->with('failure', WebStatus::CREATE_FAILED_MESSAGE);
        }
        
        return Redirect::route('admin.topics.index')
            ->with('code', WebStatus::CREATE_SUCCESS_CODE)
            ->with('success', WebStatus::CREATE_SUCCESS_MESSAGE);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        return view('admin.topics.edit', compact('topic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TopicRequest  $request
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(TopicRequest $request, Topic $topic)
    {
        // upload logo_file
        if ($request->hasFile('banner_file')) {
            $image = $request->file('banner_file');
            if (! $image->isValid()) {
                return Redirect::back()
                    ->withInput()
                    ->with('code', WebStatus::IMAGE_UPLOAD_FAILED_CODE)
                    ->with('failure', WebStatus::IMAGE_UPLOAD_FAILED_CODE);
            }
            $topic_save_folder = config('custom.topic_banners_save_path');
            $full_banner_path = upload_image($image, $topic_save_folder, 670, 827);
            $request->merge(['banner' => $full_banner_path]);
        }

        $request->merge(['body' => htmlspecialchars_decode($request->body)]);
        $result = $topic->update($request->except(['_method', '_token', 'previous', 'app_ids', 'banner_file']));
        $app_ids = collect(explode(',', $request->input('app_ids')));
        $exists_app_ids = $topic->apps->pluck('id');
        $insert_ids = $app_ids->diff($exists_app_ids);
        $delete_ids = $exists_app_ids->diff($app_ids);

        // insert new app_ids
        if ($insert_ids->count() > 0) {
            $topic->apps()->attach($insert_ids);
        }

        // delete surplus app_ids
        if ($delete_ids->count() > 0) {
            $topic->apps()->detach($delete_ids);
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
     *
     * @param  \App\Models\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
        $topic->delete();
        
        if (! $topic->trashed()) {
            return Redirect::back()
                ->with('code', WebStatus::DELETE_FAILED_CODE)
                ->with('failure', WebStatus::DELETE_FAILED_MESSAGE);
        }
        
        return Redirect::back()
            ->with('code', WebStatus::DELETE_SUCCESS_CODE)
            ->with('success', WebStatus::DELETE_SUCCESS_MESSAGE);
    }
}
