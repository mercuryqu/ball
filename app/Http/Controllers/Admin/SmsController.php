<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sms;
use Illuminate\Http\Request;

class SmsController extends AdminBaseController
{
    /**
     * Define a new resource var
     * @var $sms
     */
    protected $sms;

    /**
     * Create a new sms instance.
     *
     * @param  \App\Models\Sms  $sms
     */
    public function __construct(Sms $sms)
    {
        $this->sms = $sms;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter_telephone = $request->input('filter_telephone');
        $filter_code = $request->input('filter_code');
        $filter_type = $request->input('filter_type');
        $filter_status = $request->input('filter_status');

        $sms = $this->sms
            ->filterTelephone($filter_telephone)
            ->filterType($filter_type)
            ->filterCode($filter_code)
            ->filterStatus($filter_status)
            ->orderByCreatedAtAndId()
            ->paginate();

        return view('admin.sms.index', compact('sms', 'filter_telephone', 'filter_code', 'filter_type', 'filter_status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sms  $sms
     * @return \Illuminate\Http\Response
     */
    public function show(Sms $sms)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sms  $sms
     * @return \Illuminate\Http\Response
     */
    public function edit(Sms $sms)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sms  $sms
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sms $sms)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sms  $sms
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sms $sms)
    {
        //
    }
}
