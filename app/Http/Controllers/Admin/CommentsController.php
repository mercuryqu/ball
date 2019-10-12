<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\WebStatus;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CommentsController extends AdminBaseController
{
    /**
     * Define a new resource var
     * @var $comment
     */
    protected $comment;

    /**
     * Create a new comment instance.
     *
     * @param  \App\Models\Comment  $comment
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter_app_name = $request->input('filter_app_name');
        $filter_member_name = $request->input('filter_member_name');
        $filter_is_reply = $request->input('filter_is_reply');
        $filter_status = $request->input('filter_status');
        $filter_body = $request->input('filter_body');

        $comments = $this->comment
            ->with(['app', 'member', 'reply'])
            ->filterAppName($filter_app_name)
            ->filterMemberName($filter_member_name)
            ->filterIsReply($filter_is_reply)
            ->filterBody($filter_body)
            ->filterStatus($filter_status)
            ->orderByCreatedAtAndId()
            ->paginate();

        return view('admin.comments.index', compact('comments', 'filter_app_name', 'filter_member_name', 'filter_status', 'filter_body'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.comments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        $result = $this->comment->create($request->except('_token'));
        
        if (! $result) {
            return Redirect::back()
                ->withInput()
                ->with('code', WebStatus::CREATE_FAILED_CODE)
                ->with('failure', WebStatus::CREATE_FAILED_MESSAGE);
        }
        
        return Redirect::route('admin.comments.index')
            ->with('code', WebStatus::CREATE_SUCCESS_CODE)
            ->with('success', WebStatus::CREATE_SUCCESS_MESSAGE);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        return view('admin.comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CommentRequest  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(CommentRequest $request, Comment $comment)
    {
        $result = $comment->update($request->except(['_method', '_token', 'previous']));
        
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
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        if (! $comment->trashed()) {
            return Redirect::back()
                ->with('code', WebStatus::DELETE_FAILED_CODE)
                ->with('failure', WebStatus::DELETE_FAILED_MESSAGE);
        }

        if (count($comment->reply()) > 0) {
            $comment->reply()->delete();
        }

        return Redirect::back()
            ->with('code', WebStatus::DELETE_SUCCESS_CODE)
            ->with('success', WebStatus::DELETE_SUCCESS_MESSAGE);
    }
}
