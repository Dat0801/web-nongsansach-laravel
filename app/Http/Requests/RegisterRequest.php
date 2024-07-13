<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required',
            'address' => 'required',
            'province' => 'required',
            'district' => 'required',
            'ward' => 'required',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password'
        ];
    }

    //create message
    public function messages()
    {
        return [
            'name.required' => 'Tên không được để trống',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'phone_number.required' => 'Số điện thoại không được để trống',
            'address.required' => 'Địa chỉ không được để trống',
            'province.required' => 'Tỉnh/Thành phố không được để trống',
            'district.required' => 'Quận/Huyện không được để trống',
            'ward.required' => 'Phường/Xã không được để trống',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'password_confirmation.required' => 'Nhập lại mật khẩu không được để trống',
            'password_confirmation.same' => 'Nhập lại mật khẩu không khớp'
        ];
    }
}
