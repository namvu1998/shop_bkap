<?php

namespace App\Http\Requests;

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
            'quantity' => 'required|integer',
        ];
    }
    public function messages()
    {
        return [
            'quantity.required' => 'Không được để trống trường này!',
            'quantity.integer' => 'Giá phải là số dương',
        ];
    }
}
