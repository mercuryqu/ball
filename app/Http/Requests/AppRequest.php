<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class AppRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        Validator::extendImplicit('category_id_exists_validate', function ($attribute, $value, $parameters, $validator) {
            if (strlen($value) > 0) {
                $category_ids = collect(explode(',', $value));
                $categories = Category::pluck('id');

                foreach ($category_ids as $item) {
                    if (! $categories->contains($item)) {
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
                    'name' => 'required|min:2|max:30|unique:apps',
                    'slogan' => 'required|min:3|max:30',
                    'instruction' => 'required|min:5|max:300',
                    'member_id' => 'required|integer|exists:members,id',
                    'logo_file' => 'required|image|mimes:jpeg,jpg,bmp,png|max:' . config('custom.app_logos_max_size') . '|dimensions:width=' . config('custom.app_logos_width') .',height=' . config('custom.app_logos_height'),
                    'code_file' => 'required|image|mimes:jpeg,jpg,bmp,png|max:' . config('custom.app_codes_max_size') . '|dimensions:width=' . config('custom.app_codes_width') .',height=' . config('custom.app_codes_height'),
                    'images_files' => 'required',
                    'images_files.*' => 'image|mimes:jpeg,jpg,bmp,png|max:' . config('custom.app_images_max_size') . '|dimensions:width=' . config('custom.app_images_width') .',height=' . config('custom.app_images_height'),
                    'categories' => 'required|category_id_exists_validate',
                    'status' => 'required|integer|in:0,1,2',
                ];
                break;

            // UPDATE
            case 'PUT':
                return [
                    'id' => 'required|integer|exists:apps',
                    'name' => 'required|min:2|max:30|unique:apps,name,'.$this->id,
                    'instruction' => 'required|min:5|max:300',
                    'member_id' => 'required|integer|exists:members,id',
                    'logo_file' => 'image|mimes:jpeg,jpg,bmp,png|max:' . config('custom.app_logos_max_size') . '|dimensions:width=' . config('custom.app_logos_width') .',height=' . config('custom.app_logos_height'),
                    'code_file' => 'image|mimes:jpeg,jpg,bmp,png|max:' . config('custom.app_codes_max_size') . '|dimensions:width=' . config('custom.app_codes_width') .',height=' . config('custom.app_codes_height'),
                    'images_files.*' => 'image|mimes:jpeg,jpg,bmp,png|max:' . config('custom.app_images_max_size') . '|dimensions:width=' . config('custom.app_images_width') .',height=' . config('custom.app_images_height'),
                    'categories' => 'required|category_id_exists_validate',
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
            'slogan' => '口号',
            'instruction' => '简介',
            'member_id' => '会员ID',
            'logo_file' => 'Logo',
            'code_file' => '二维码',
            'images_files' => '展示图',
            'images_files.*' => '展示图',
            'categories' => '分类ID',
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
            'categories.category_id_exists_validate' => '关联分类ID中有ID不存在！',
        ];
    }
}
