<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\WebStatus;
use App\Models\AppTopic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AppTopicController extends AdminBaseController
{
    /**
     * Define a new resource var
     * @var $app_topic
     */
    protected $app_topic;

    /**
     * Create a new member instance.
     *
     * @param  \App\Models\AppTopic  $app_topic
     */
    public function __construct(AppTopic $app_topic)
    {
        $this->app_topic = $app_topic;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter_app_id = $request->input('filter_app_id');
        $filter_topic_id = $request->input('filter_topic_id');
        $filter_app_name = $request->input('filter_app_name');
        $filter_topic_name = $request->input('filter_topic_name');
        $app_topics = $this->app_topic
            ->with(['app', 'topic'])
            ->filterAppId($filter_app_id)
            ->filterTopicId($filter_topic_id)
            ->filterAppName($filter_app_name)
            ->filterTopicName($filter_topic_name)
            ->latest('sort')
            ->orderByCreatedAtAndId()
            ->paginate();

        return view('admin.app_topic.index', compact('app_topics', 'filter_app_id', 'filter_topic_id', 'filter_app_name', 'filter_topic_name'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AppTopic  $app_topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppTopic $app_topic)
    {
        $app_topic->delete();

        if (! $app_topic->trashed()) {
            return Redirect::back()
                ->with('code', WebStatus::DELETE_FAILED_CODE)
                ->with('failure', WebStatus::DELETE_FAILED_MESSAGE);
        }

        return Redirect::back()
            ->with('code', WebStatus::DELETE_SUCCESS_CODE)
            ->with('success', WebStatus::DELETE_SUCCESS_MESSAGE);
    }
}
