<?php

namespace App\Http\Requests;

class MemberRequest extends Request
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
                    'name' => 'required|min:3|max:20|unique:members',
                    'username' => 'required|min:3|max:20|unique:members',
                    'telephone' => 'required|size:11|regex:'.config('custom.telephone_regex').'|unique:members',
                    'email' => 'required|email|unique:members',
                    'avatar' => 'required',
                    'status' => 'required|in:0,1,2',
                ];
                break;

            // UPDATE
            case 'PUT':
                return [
                    'id' => 'required|integer|exists:members',
                    'name' => 'required|min:3|max:20|unique:members,name,'.$this->id,
                    'username' => 'required|min:3|max:20|unique:members,username,'.$this->id,
                    'telephone' => 'required|size:11|regex:'.config('custom.telephone_regex').'|unique:members,telephone,'.$this->id,
                    'email' => 'required|email|unique:members,email,'.$this->id,
                    'avatar' => 'required',
                    'status' => 'required|in:0,1,2',
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
            'telephone' => '手机号'
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
