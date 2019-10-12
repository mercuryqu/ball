<?php

namespace App\Http\Requests;

use App\Models\App;
use App\Models\Topic;
use Illuminate\Support\Facades\Validator;

class ModuleRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        Validator::extendImplicit('modulegable_id_exists_validate', function ($attribute, $value, $parameters, $validator) {
            if (strlen($value) > 0) {
                $type = $parameters[0];
                $modulegable_ids = collect(explode(',', $value));

                if (in_array($type, [0, 2])) {
                    $modulegable_id = Topic::pluck('id');
                } elseif (in_array($type, [1, 3])) {
                    $modulegable_id = App::pluck('id');
                }

                foreach ($modulegable_ids as $item) {
                    if (! $modulegable_id->contains($item)) {
                        return false;
                    }
                }
            }
            return true;
        });

        switch($this->method())
        {
            // CREATE
            case 'POST':
                return [
                    'name' => 'required|min:2|max:30|unique:modules',
                    'type' => 'required|integer|in:0,1,2,3',
                    'modulegable_ids' => 'required|modulegable_id_exists_validate:' . $this->type,
                    'sort' => 'required|integer|min:0',
                    'status' => 'required|integer|in:0,1',
                ];
                break;

            // UPDATE
            case 'PUT':
                return [
                    'id' => 'required|integer|exists:apps',
                    'name' => 'required|min:2|max:30|unique:modules,name,'.$this->id,
                    'type' => 'required|integer|in:0,1,2,3',
                    'modulegable_ids' => 'required|modulegable_id_exists_validate:' . $this->type,
                    'sort' => 'required|integer|min:0',
                    'status' => 'required|integer|in:0,1',
                ];
                break;

            case 'PATCH':
                return [
                    // UPDATE ROLES
                ];
                break;

            case 'GET':
                break;

            case 'DELETE':
                break;

            default:
                return [];
                break;
        }
    }

    /**
     * Define field assign to means.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'type' => '类型',
            'modulegable_ids' => '关联对象ID',
            'sort' => '排序',
        ];
    }

    /**
     * Get the validation rules message that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'modulegable_ids.modulegable_id_exists_validate' => '关联对象ID中有ID不存在！',
        ];
    }
}
