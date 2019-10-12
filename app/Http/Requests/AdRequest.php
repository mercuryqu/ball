<?php

namespace App\Http\Requests;

class AdRequest extends Request
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
                    'name' => 'required|min:2|max:30|unique:ads',
                    'instruction' => 'required|min:5|max:500',
                    'jump_type' => 'required|integer|in:0,1',
                    'app_id' => 'required_unless:jump_type,1',
                    'image_file' => 'required|image|mimes:jpeg,jpg,bmp,png|max:' . config('custom.ad_images_max_size') . '|dimensions:width=' . config('custom.ad_images_width') .',height=' . config('custom.ad_images_height'),
                    'jump_url' => 'required_unless:jump_type,0',
                    'platform' => 'required|integer|in:0,1',
                    'ad_position_id' => 'required|integer|exists:ad_positions,id',
                    'start_at' => 'required|date|date_format:Y-m-d H:i:s|before:end_at',
                    'end_at' => 'required|date|date_format:Y-m-d H:i:s|after:start_at',
                    'sort' => 'required|integer|min:0',
                    'status' => 'required|integer|in:0,1,2',
                ];
                break;

            // UPDATE
            case 'PUT':
                return [
                    'id' => 'required|integer|exists:ads',
                    'name' => 'required|min:2|max:30|unique:ad_positions,name,'.$this->id,
                    'instruction' => 'required|min:5|max:500',
                    'jump_type' => 'required|integer|in:0,1',
                    'app_id' => 'required_unless:jump_type,1',
                    'image_file' => 'image|mimes:jpeg,jpg,bmp,png|max:' . config('custom.ad_images_max_size') . '|dimensions:width=' . config('custom.ad_images_width') .',height=' . config('custom.ad_images_height'),
                    'jump_url' => 'required_unless:jump_type,0',
                    'platform' => 'required|integer|in:0,1',
                    'ad_position_id' => 'required|integer|exists:ad_positions,id',
                    'start_at' => 'required|date|date_format:Y-m-d H:i:s|before:end_at',
                    'end_at' => 'required|date|date_format:Y-m-d H:i:s|after:start_at',
                    'sort' => 'required|integer|min:0',
                    'status' => 'required|integer|in:0,1,2',
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
            'instruction' => '简介',
            'jump_type' => '跳转类型',
            'app_id' => '小程序ID',
            'image_file' => '广告图',
            'jump_url' => '跳转链接',
            'platform' => '平台',
            'ad_position_id' => '广告位ID',
            'start_at' => '开始时间',
            'end_at' => '结束时间',
            'sort' => '排序'
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
