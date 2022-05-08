<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAttr extends FormRequest
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
            'value' => 'required|unique:attributes',
        ];
    }

    public function messages()
    {
        return [
            'value.required' => 'Giá trị không được bỏ chống.',
            'value.unique' => 'Giá trị này đã sử dụng.',
        ];
    }
}
