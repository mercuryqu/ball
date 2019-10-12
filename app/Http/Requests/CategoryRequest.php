<?php

namespace App\Http\Requests;

class CategoryRequest extends Request
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
                    'name' => 'required|min:1|max:20|unique:categories,name,'.$this->parent_category_id,
                    'parent_category_id' => 'required|integer|min:0',
                    'icon_file' => 'required|image|mimes:jpeg,jpg,bmp,png|max:' . config('custom.category_icons_max_size') . '|dimensions:width=' . config('custom.category_icons_width') .',height=' . config('custom.category_icons_height'),
                    'sort' => 'required|integer|min:0',
                    'status' => 'required|integer|in:0,1',
                ];
                break;

            // UPDATE
            case 'PUT':
                return [
                    'id' => 'required|integer|exists:categories',
                    'name' => 'required|min:1|max:20|unique:categories,name,'.$this->id,
                    'icon_file' => 'image|mimes:jpeg,jpg,bmp,png|max:' . config('custom.category_icons_max_size') . '|dimensions:width=' . config('custom.category_icons_width') .',height=' . config('custom.category_icons_height'),
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
            'parent_category_id' => '上级分类ID',
            'icon_file' => '图标',
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

        ];
    }
}
