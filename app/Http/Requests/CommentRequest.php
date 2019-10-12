<?php

namespace App\Http\Requests;

class CommentRequest extends Request
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
                    'app_id' => 'required|integer|exists:apps,id',
                    'member_id' => 'required|integer|exists:members,id',
                    'star' => 'required|integer|in:1,2,3,4,5',
                    'body' => 'required|min:10|max:150',
                    'status' => 'required|in:0,1',
                ];
                break;

            // UPDATE
            case 'PUT':
                return [
                    'id' => 'required|integer|exists:comments',
                    'star' => 'required|integer|in:1,2,3,4,5',
                    'body' => 'required|min:10|max:150',
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
            'app_id' => '小程序ID',
            'member_id' => '会员ID',
            'star' => '评分',
            'body' => '内容',
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
