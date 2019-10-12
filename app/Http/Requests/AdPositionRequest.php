<?php

namespace App\Http\Requests;

class AdPositionRequest extends Request
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
                    'name' => 'required|min:3|max:20|unique:ad_positions',
                    'position' => 'required|min:3|max:20|unique:ad_positions',
                    'platform' => 'required|in:0,1',
                    'status' => 'required|in:0,1',
                ];
                break;

            // UPDATE
            case 'PUT':
                return [
                    'id' => 'required|integer|exists:ad_positions',
                    'name' => 'required|min:3|max:20|unique:ad_positions,name,'.$this->id,
                    'position' => 'required|min:3|max:20|unique:ad_positions,position,'.$this->id,
                    'platform' => 'required|in:0,1',
                    'status' => 'required|in:0,1',
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
            'platform' => '平台',
            'position' => '位置',
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
