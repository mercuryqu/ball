<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\WebStatus;
use App\Http\Requests\ModuleRequest;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ModulesController extends AdminBaseController
{
    /**
     * Define a new resource var
     * @var $module
     */
    protected $module;

    /**
     * Create a new ad_position instance.
     *
     * @param  \App\Models\Module  $module
     */
    public function __construct(Module $module)
    {
        $this->module = $module;
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
        $filter_type = $request->input('filter_type');
        $filter_status = $request->input('filter_status');

        $modules = $this->module
            ->filterName($filter_name)
            ->filterType($filter_type)
            ->filterStatus($filter_status)
            ->latest('sort')
            ->orderByCreatedAtAndId()
            ->paginate();

        return view('admin.modules.index', compact('modules', 'filter_name', 'filter_type', 'filter_status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.modules.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ModuleRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ModuleRequest $request)
    {
        // save module info
        $result = $this->module->create($request->except(['_token', 'modulegable_id']));

        // save modulegable_ids info
        $type = $request->input('type');
        $modulegable_ids = explode(',', $request->input('modulegable_ids'));
        if (in_array($type, [0, 2])) {
            $result->topics()->attach($modulegable_ids);
        } elseif (in_array($type, [1, 3])) {
            $result->apps()->attach($modulegable_ids);
        }

        if (! $result) {
            return Redirect::back()
                ->withInput()
                ->with('code', WebStatus::CREATE_FAILED_CODE)
                ->with('failure', WebStatus::CREATE_FAILED_MESSAGE);
        }

        return Redirect::route('admin.modules.index')
            ->with('code', WebStatus::CREATE_SUCCESS_CODE)
            ->with('success', WebStatus::CREATE_SUCCESS_MESSAGE);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function show(Module $module)
    {
        return view('admin.modules.show', compact('module'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function edit(Module $module)
    {
        return view('admin.modules.edit', compact('module'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ModuleRequest  $request
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ModuleRequest $request, Module $module)
    {
        $result = $module->update($request->except(['_method', '_token', 'previous', 'modulegable_id']));

        // save modulegable_ids info
        $type = $request->input('type');

        $modulegable_ids = collect(explode(',', $request->input('modulegable_ids')));

        if (in_array($type, [0, 2])) {
            $exists_module_ids = $module->topics->pluck('id');
        } elseif (in_array($type, [1, 3])) {
            $exists_module_ids = $module->apps->pluck('id');
        }

        $insert_ids = $modulegable_ids->diff($exists_module_ids);
        $delete_ids = $exists_module_ids->diff($modulegable_ids);

        // insert new module_ids
        if ($insert_ids->count() > 0) {
            if (in_array($type, [0, 2])) {
                $module->topics()->attach($insert_ids);
            } elseif (in_array($type, [1, 3])) {
                $module->apps()->attach($insert_ids);
            }
        }

        // delete surplus module_ids
        if ($delete_ids->count() > 0) {
            if (in_array($type, [0, 2])) {
                $module->topics()->detach($delete_ids);
            } elseif (in_array($type, [1, 3])) {
                $module->apps()->detach($delete_ids);
            }
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
     * @param App $module
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Module $module)
    {
        $module->delete();

        if ($module->trashed()) {
            return Redirect::back()
                ->with('code', WebStatus::DELETE_SUCCESS_CODE)
                ->with('success', WebStatus::DELETE_SUCCESS_MESSAGE);
        }

        return Redirect::back()
            ->with('code', WebStatus::DELETE_FAILED_CODE)
            ->with('failure', WebStatus::DELETE_FAILED_MESSAGE);
    }
}
