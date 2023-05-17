<?php

namespace App\Http\Requests\Login;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => request()->route('id') 
                    ? 'required|email|unique:users,email,'.request()->route('id')
                    : 'required|email|unique:users',

            'password' => request()->route('id') 
            ? 'confirmed' 
            : 'required|confirmed|min:8|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',

        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'Vui lòng nhập email',
            'email.unique' => 'Email này đã tồn tại rồi',
            'email.email' => 'Đây không phải là email',

            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.confirmed' => 'Mật khẩu xác nhận không chính xác',
            'password.min'  => 'Mật khẩu ít nhất 8 ký tự',
            'password.regex' => 'Mật khẩu phải có cả chữ và số',
    
        ];
    }
}
