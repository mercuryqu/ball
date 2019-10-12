<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\WebStatus;
use App\Models\Modulegable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ModulegablesController extends AdminBaseController
{
    /**
     * Define a new resource var
     * @var $modulegable
     */
    protected $modulegable;

    /**
     * Create a new member instance.
     *
     * @param  \App\Models\Module  $module
     */
    public function __construct(Modulegable $modulegable)
    {
        $this->modulegable = $modulegable;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter_module_id = $request->input('filter_module_id');
        $filter_module_name = $request->input('filter_module_name');
        $filter_module_type = $request->input('filter_module_type');
        $modulegables = $this->modulegable
            ->with('module')
            ->filterModuleId($filter_module_id)
            ->filterModuleName($filter_module_name)
            ->filterModuleType($filter_module_type)
            ->latest('sort')
            ->orderByCreatedAtAndId()
            ->paginate();

        return view('admin.modulegables.index', compact('modulegables', 'filter_module_id', 'filter_module_name', 'filter_module_type'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Modulegable $modulegable)
    {
        $modulegable->delete();

        if (! $modulegable->trashed()) {
            return Redirect::back()
                ->with('code', WebStatus::DELETE_FAILED_CODE)
                ->with('failure', WebStatus::DELETE_FAILED_MESSAGE);
        }

        return Redirect::back()
            ->with('code', WebStatus::DELETE_SUCCESS_CODE)
            ->with('success', WebStatus::DELETE_SUCCESS_MESSAGE);
    }
}
