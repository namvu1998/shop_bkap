<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateVariant extends FormRequest
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
            'color_id' => ['required',Rule::unique('product_variants')->where(function ($query){
                return $query->where('size_id', $this->size_id)
                            ->where('product_id', $this->product_id)
                            ->where('id','!=', $this->id);
            })],
            'size_id' => 'required',
            'quantity' => 'required|integer',
        ];
    }
    public function messages()
    {
        return [
            'color_id.required' => 'Không được để trống trường này!',
            'size_id.required' => 'Không được để trống trường này!',
            'color_id.unique' => 'Biến thể đã tồn tại!',
            'quantity.required' => 'Không được để trống trường này!',
            'quantity.integer' => 'Giá phải là số dương!',
        ];
    }
}
