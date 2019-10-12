<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\WebStatus;
use App\Http\Requests\MemberRequest;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MembersController extends AdminBaseController
{
    /**
     * Define a new resource var
     * @var $member
     */
    protected $member;

    /**
     * Create a new member instance.
     *
     * @param  \App\Models\Member  $member
     */
    public function __construct(Member $member)
    {
        $this->member = $member;
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
        $filter_username = $request->input('filter_username');
        $filter_telephone = $request->input('filter_telephone');
        $filter_email = $request->input('filter_email');
        $filter_status = $request->input('filter_status');
        
        $members = $this->member
            ->filterName($filter_name)
            ->filterUserName($filter_username)
            ->filterTelephone($filter_telephone)
            ->filterEmail($filter_email)
            ->filterStatus($filter_status)
            ->orderByCreatedAtAndId()
            ->paginate();

        return view('admin.members.index', compact('members', 'filter_name', 'filter_username', 'filter_telephone', 'filter_email', 'filter_status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.members.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MemberRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MemberRequest $request)
    {
        $result = $this->member->create($request->except('_token'));
        
        if (! $result) {
            return Redirect::back()
                ->withInput()
                ->with('code', WebStatus::CREATE_FAILED_CODE)
                ->with('failure', WebStatus::CREATE_FAILED_MESSAGE);
        }
        
        return Redirect::route('admin.members.index')
            ->with('code', WebStatus::CREATE_SUCCESS_CODE)
            ->with('success', WebStatus::CREATE_SUCCESS_MESSAGE);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        return view('admin.members.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MemberRequest  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(MemberRequest $request, Member $member)
    {
        $result = $member->update($request->except(['_method', '_token', 'previous']));
        
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
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        $member->delete();
        
        if (! $member->trashed()) {
            return Redirect::back()
                ->with('code', WebStatus::DELETE_FAILED_CODE)
                ->with('failure', WebStatus::DELETE_FAILED_MESSAGE);
        }
        
        return Redirect::back()
            ->with('code', WebStatus::DELETE_SUCCESS_CODE)
            ->with('success', WebStatus::DELETE_SUCCESS_MESSAGE);
    }
}
