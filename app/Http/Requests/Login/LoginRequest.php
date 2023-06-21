<?php

namespace App\Http\Requests\Login;

use Illuminate\Foundation\Http\FormRequest;
use Biscolab\ReCaptcha\Facades\ReCaptcha;
class LoginRequest extends FormRequest
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
    public function rules()
    {
        return [
            'email' =>'required',
            'password'=>'required',
            'g-recaptcha-response' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Vui lòng nhập Email ',
            'password.required' => 'Vui lòng nhập mật khẩu của bạn',
            'g-recaptcha-response.required' =>'Vui lòng xác thực nếu bạn không phải robot',
        ];
    }
}
