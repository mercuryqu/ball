<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\WebStatus;
use Illuminate\Http\Request;

class CommonController extends AdminBaseController
{
    /**
     * Define a new resource var
     * @var $module
     */
    protected $modules = [
        'modules' => 'Module',
        'modulegables' => 'Modulegable',
        'categories' => 'Category',
        'keywords' => 'Keyword',
        'app_category' => 'AppCategory',
        'app_topic' => 'AppTopic',
        'ads' => 'Ad',
    ];

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sort(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|integer',
            'sort' => 'required|integer|min:0',
            'module' => 'required',
        ], [], [
            'id.required' => 'id必须传'
        ]);
        $sort = $request->input('sort');
        $id = $request->input('id');
        $module = $request->input('module');
        $obj = null;
        if (! (isset($this->modules[$module]) && array_key_exists($module, $this->modules))) {
            return $this->apiShow(WebStatus::OBJECT_NOT_FOUND_FAILED_CODE, WebStatus::OBJECT_NOT_FOUND_FAILED_MESSAGE);
        }

        $class = '\App\Models\\' . $this->modules[$module];
        $obj = new $class();
        $module_obj = $obj->findOrFail($id);
        $module_obj->sort = $sort;
        $result = $module_obj->save();
        if (! $result) {
            return $this->apiShow(WebStatus::UPDATE_FAILED_CODE, WebStatus::UPDATE_FAILED_MESSAGE);
        }

        return $this->apiShow(WebStatus::UPDATE_SUCCESS_CODE, WebStatus::UPDATE_SUCCESS_MESSAGE);
    }
}
