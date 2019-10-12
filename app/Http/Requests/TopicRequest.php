<?php

namespace App\Http\Requests;

use App\Models\App;
use Illuminate\Support\Facades\Validator;

class TopicRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        Validator::extendImplicit('app_id_exists_validate', function ($attribute, $value, $parameters, $validator) {
            if (strlen($value) > 0) {
                $app_id_array = collect(explode(',', $value));
                $app_ids_collection = App::pluck('id');

                foreach ($app_id_array as $item) {
                    if (! $app_ids_collection->contains($item)) {
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
                    'title' => 'required|min:3|max:150',
                    'body' => 'required|min:10',
                    'banner_file' => 'required|image|mimes:jpeg,jpg,bmp,png|dimensions:ratio=670/827',
                    'app_ids' => 'required|app_id_exists_validate',
                    'status' => 'required|in:0,1'
                ];
                break;

            // UPDATE
            case 'PUT':
                return [
                    'title' => 'required|min:3|max:150',
                    'body' => 'required|min:10',
                    'banner_file' => 'image|mimes:jpeg,jpg,bmp,png|dimensions:ratio=670/827',
                    'app_ids' => 'required|app_id_exists_validate',
                    'status' => 'required|in:0,1'
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
            'body' => '内容',
            'app_ids' => '关联小程序ID',
            'banner_file' => 'Banner图',
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
            'app_ids.app_id_exists_validate' => '关联小程序ID中有ID不存在！'
        ];
    }
}
