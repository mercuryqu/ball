<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\WebStatus;
use App\Http\Requests\KeywordRequest;
use App\Models\Keyword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class KeywordsController extends AdminBaseController
{
    /**
     * Define a new resource var
     * @var $keyword
     */
    protected $keyword;

    /**
     * Create a new keyword instance.
     *
     * @param  \App\Models\Keyword  $keyword
     */
    public function __construct(Keyword $keyword)
    {
        $this->keyword = $keyword;
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
        $filter_status = $request->input('filter_status');

        $keywords = $this->keyword
            ->filterName($filter_name)
            ->filterStatus($filter_status)
            ->latest('sort')
            ->orderByCreatedAtAndId()
            ->paginate();

        return view('admin.keywords.index', compact('keywords', 'filter_name', 'filter_status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.keywords.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\KeywordRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KeywordRequest $request)
    {
        $result = $this->keyword->create($request->except('_token'));

        if (! $result) {
            return Redirect::back()
                ->withInput()
                ->with('code', WebStatus::CREATE_FAILED_CODE)
                ->with('failure', WebStatus::CREATE_FAILED_MESSAGE);
        }

        return Redirect::route('admin.keywords.index')
            ->with('code', WebStatus::CREATE_SUCCESS_CODE)
            ->with('success', WebStatus::CREATE_SUCCESS_MESSAGE);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Keyword  $keyword
     * @return \Illuminate\Http\Response
     */
    public function show(Keyword $keyword)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Keyword  $keyword
     * @return \Illuminate\Http\Response
     */
    public function edit(Keyword $keyword)
    {
        return view('admin.keywords.edit', compact('keyword'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\KeywordRequest  $request
     * @param  \App\Models\Keyword  $keyword
     * @return \Illuminate\Http\Response
     */
    public function update(KeywordRequest $request, Keyword $keyword)
    {
        $result = $keyword->update($request->except(['_method', '_token', 'previous']));

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
     * @param  \App\Models\Keyword  $keyword
     * @return \Illuminate\Http\Response
     */
    public function destroy(Keyword $keyword)
    {
        $keyword->delete();

        if (! $keyword->trashed()) {
            return Redirect::back()
                ->with('code', WebStatus::DELETE_FAILED_CODE)
                ->with('failure', WebStatus::DELETE_FAILED_MESSAGE);
        }

        return Redirect::back()
            ->with('code', WebStatus::DELETE_SUCCESS_CODE)
            ->with('success', WebStatus::DELETE_SUCCESS_MESSAGE);
    }
}
