<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'fullname' => 'required',

            'phone' => request()->route('uuid') 
                    ? 'required:users,phone,'.request()->route('uuid')
                    : 'required:users',
            'email'      => request()->route('uuid')
            ? 'required|max:255|' . Rule::unique('users')->ignore(request()->route('uuid'), 'uuid')
            : 'required|max:255|unique:users,email',

            'password' => request()->route('uuid') 
            ? 'confirmed' 
            : 'required|confirmed|min:8|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',

            'avatar' => request()->route('uuid')
                    ? 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                    : 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        
        ];
    }
    public function messages()
    {
        return [
            'fullname.required' => 'Vui lòng nhập Họ và tên ',

            'phone.required' => 'Vui lòng nhập SĐT của bạn',
            
            'email.required' => 'Vui lòng nhập email',
            'email.unique' => 'Email này đã tồn tại rồi',
            'email.email' => 'Đây không phải là email',

            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.confirmed' => 'Mật khẩu xác nhận không chính xác',
            'password.min'  => 'Mật khẩu ít nhất 8 ký tự',
            'password.regex' => 'Mật khẩu phải có cả chữ và số',
            
            'avatar.required' => 'Vui lòng nhập hình đại diện',
            'avatar.mimes' => 'Hình đại diện phải là các loại png,bmp,jpg'
        ];
    }
}
