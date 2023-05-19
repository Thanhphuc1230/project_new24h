<?php

namespace App\Http\Requests\Website;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'fullname' => 'required',

            'phone' => request()->route('uuid')
            ? 'required:users,phone|min:9,' . request()->route('uuid')
            : 'required|unique:users,phone',
    
        
        ];
    }
    public function messages()
    {
        return [
            'fullname.required' => 'Vui lòng nhập Họ và tên ',

            'phone.required' => 'Vui lòng nhập SĐT của bạn',
            'phone.unique' => 'SĐT này đã tồn tại rồi,vui lòng thử số khác',
            'phone.min' => 'SĐT phải có ít nhất 9 số',
        ];
    }
}
