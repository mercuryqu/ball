<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\WebStatus;
use App\Http\Requests\ReplyRequest;
use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RepliesController extends AdminBaseController
{
    /**
     * Define a new resource var
     * @var $reply
     */
    protected $reply;
    
    /**
     * Define a new resource var
     * @var $comment
     */
    protected $comment;

    /**
     * Create a new reply instance.
     *
     * @param  \App\Models\Reply  $reply
     * @param  \App\Models\Comment  $comment
     */
    public function __construct(Reply $reply, Comment $comment)
    {
        $this->reply = $reply;
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
        $filter_app_name = $request->input('filter_user_name');
        $filter_member_name = $request->input('filter_member_name');
        $filter_status = $request->input('filter_status');

        $replies = $this->reply
            ->with(['user', 'comment.member', 'comment'])
//            ->filterAppName($filter_app_name)
//            ->filterMemberName($filter_member_name)
            ->filterStatus($filter_status)
            ->orderByCreatedAtAndId()
            ->paginate();

        return view('admin.replies.index', compact('replies', 'filter_user_name', 'filter_status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'comment_id' => 'required|integer|exists:comments,id',
            'previous' => 'required',
        ]);
        $comment_id = $request->input('comment_id');
        $previous = $request->input('previous');
        $previous = $previous ? $previous : route('admin.replies.index');
        $comment = $comment_id ? Comment::findOrFail($comment_id) : '';
        return view('admin.replies.create', compact('comment', 'previous'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ReplyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReplyRequest $request)
    {
        $previous = $request->input('previous');
        $comment_id = $request->input('comment_id');
        $request->merge(['user_id' => Auth::id()]);
        $result = $this->reply->create($request->except('_token', 'previous'));

        if (! $result) {
            return Redirect::back()
                ->withInput()
                ->with('code', WebStatus::CREATE_FAILED_CODE)
                ->with('failure', WebStatus::CREATE_FAILED_MESSAGE);
        }

        // update comment's is_reply field to done
        $this->comment->find($comment_id)->update(['is_reply' => true]);

        return Redirect::to($previous)
            ->with('code', WebStatus::CREATE_SUCCESS_CODE)
            ->with('success', WebStatus::CREATE_SUCCESS_MESSAGE);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function show(Reply $reply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Reply $reply)
    {
        $comment_id = $request->input('comment_id');
        if ($comment_id) {
            $this->validate($request, [
                'comment_id' => 'integer|exists:comments,id',
                'previous' => 'required',
            ]);
        }

        $previous = $request->input('previous');
        $previous = $previous ? $previous : url()->previous();
        $comment = $comment_id ? Comment::findOrFail($comment_id) : '';
        return view('admin.replies.edit', compact('reply', 'previous', 'comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ReplyRequest  $request
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(ReplyRequest $request, Reply $reply)
    {
        $result = $reply->update($request->except(['_method', '_token', 'previous']));

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
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reply $reply)
    {
        $reply->delete();

        if (! $reply->trashed()) {
            return Redirect::back()
                ->with('code', WebStatus::DELETE_FAILED_CODE)
                ->with('failure', WebStatus::DELETE_FAILED_MESSAGE);
        }

        return Redirect::back()
            ->with('code', WebStatus::DELETE_SUCCESS_CODE)
            ->with('success', WebStatus::DELETE_SUCCESS_MESSAGE);
    }
}
