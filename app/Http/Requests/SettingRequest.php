<?php

namespace App\Http\Requests;

class SettingRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch($this->method())
        {
            // CREATE
            case 'POST':
                return [
                    'key' => 'required|alpha_dash|unique:settings',
                    'value' => 'required',
                    'platform' => 'required|integer|in:0,1,2,3',
                ];
                break;

            // UPDATE
            case 'PUT':
                return [
                    'platform' => 'required|integer|in:0,1,2,3',
                    'value.global_app_name' => 'required_if:platform,0',
                    'value.pc_app_keyword' => 'required_if:platform,1',
                    'value.pc_app_description' => 'required_if:platform,1',
                    'value.wap_app_keyword' => 'required_if:platform,2',
                    'value.wap_app_description' => 'required_if:platform,2',
                    'value.wap_home_module_per_page' => 'required_if:platform,2',
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
            'key' => 'Key',
            'platform' => '平台',
            'value.wap_home_module_per_page' => '条数',
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

        ];
    }
}
