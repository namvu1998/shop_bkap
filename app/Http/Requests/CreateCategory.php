<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategory extends FormRequest
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
            'name' => 'required|unique:categories',
            'status' => 'required',
        ];
    }

    public function message()
    {
        return [
            'name.required' => 'Tên không được bỏ chống.',
            'name.unique' => 'Tên này đã sử dụng.',
            'status.required' => 'Trạng thái không được để chống',
        ];
    }

}
