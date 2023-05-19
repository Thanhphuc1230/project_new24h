<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {   $uuid = auth()->user()->uuid;
        return [
            'fullname' => 'required',

            'phone' =>  $uuid
            ? 'required:users,phone|min:9,' .  $uuid
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
