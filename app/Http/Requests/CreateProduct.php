<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProduct extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:50|unique:products',
            'sl' => 'required|max:50',
            'price' => 'required|integer',
            'sale_price' => 'lte:price|integer',
            'file' => 'required|mimes:jpg,jpeg,png,gif',
            'category_id' => 'required',
            'content' => 'required|max:300',
            'description' => 'required',
            'shoe_code' => 'required|max:20',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Không được để trống trường này!',
            'name.unique' => 'Tên sản phẩm đã tồn tại!',
            'sl.required' => 'Không được để trống trường này!',
            'price.required' => 'Không được để trống trường này!',
            'file.required' => 'Không được để trống trường này!',
            'category_id.required' => 'Không được để trống trường này!',
            'content.required' => 'Không được để trống trường này!',
            'description.required' => 'Không được để trống trường này!',
            'shoe_code.required' => 'Không được để trống trường này!',
            'name.max' => 'Trường này không được quá 50 ký tự!',
            'sl.max' => 'Trường này không được quá 50 ký tự!',
            'shoe_code.max' => 'Trường này không được quá 50 ký tự!',
            'price.integer' => 'Giá phải là số dương',
            'sale_price.integer' => 'Giá khuyến mãi phải là số dương',
            'sale_price.lte' => 'Giá khuyến mãi phải nhỏ hơn giá gốc',
            'file.mimes' => 'Định dạng ảnh không hợp lệ',
        ];
    }
}
