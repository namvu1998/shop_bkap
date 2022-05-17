<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|digits:10|alpha_num|regex:/^(0)+([1-9][0-9]{8})$/',
            'email' => 'required|email',
            'note' => 'max:500',
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute không được để trống!',
            'phone.digits' => 'phone phải 10 số!',
            'phone.alpha_num' => 'phone phải là số!',
            'phone.regex' => 'Đầu số không đúng định dạng!',
            'email.email' => 'Email không đúng định dạng!',
            'note.max' => 'Nội dung vượt quá giới hạn',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Họ tên',
            'email' => 'Email',
            'address' => 'Địa chỉ',
            'phone' => 'Số điện thoại',
            'note' => 'Ghi chú',
        ];
    }
}
