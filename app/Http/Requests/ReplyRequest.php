<?php

namespace App\Http\Requests;

class ReplyRequest extends Request
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
                    'previous' => 'required',
                    'body' => 'required|min:5|max:150',
                    'comment_id' => 'required|integer|exists:comments,id',
                    'status' => 'required|in:0,1',
                ];
                break;

            // UPDATE
            case 'PUT':
                return [
                    'id' => 'required|integer|exists:replies',
                    'body' => 'required|min:5|max:150',
                    'comment_id' => 'required|integer|exists:comments,id|unique:replies,comment_id,'.$this->id,
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
            'body' => '内容',
            'member_id' => '评论ID',
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
