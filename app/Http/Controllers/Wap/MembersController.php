<?php

namespace App\Http\Controllers\Wap;

use App\Models\Member;
use App\Models\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MembersController extends WapBaseController
{
    /**
     * Define a new resource var
     * @var $member
     * @var $app
     */
    protected $member;
    protected $app;

    /**
     * Create a new ad_position instance.
     *
     * @param  \App\Models\Member  $member
     */
    public function __construct(Member $member, App $app)
    {
        $this->member = $member;
        $this->app = $app;

        // Only login member can visit pages
        $this->middleware('wap.auth', [
            'except' => []
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $member = session()->get('member');
        $passed_apps = $this->app->getAppByStatus(1);
        $pending_apps = $this->app->getAppByStatus(0);
        $un_passed_apps = $this->app->getAppByStatus(2);

        $un_passed_apps->map(function ($item) {
            if ($item->appExamineLog && $item->appExamineLog->reason) {
                return $item->reasons = json_decode($item->appExamineLog->reason, true);
            }
        });

        return view('wap.members.show', compact('member', 'passed_apps', 'pending_apps', 'un_passed_apps'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->validate($request, [
            'status' => 'required|integer|in:0,1,2',
            'page' => 'required|integer'
        ]);
        $status = $request->input('status');
        $page = $request->input('page');
        return $this->app->getAppByStatus($status, $page);
    }

}
