<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $user_id = $this->route('user');
        return [
            //
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user_id,
            'password' => 'required|min:6',
            'phone_number' => 'required|phone:AUTO,VN|unique:users,phone_number,' . $user_id,          
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
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 6 kí tự',
            'phone_number.required' => 'Số điện thoại không được để trống',
            'phone_number.phone' => 'Số điện thoại không đúng định dạng',
            'phone_number.unique' => 'Số điện thoại đã tồn tại',
        ];
    }
    
}
