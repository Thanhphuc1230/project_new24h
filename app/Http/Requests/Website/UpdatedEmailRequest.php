<?php

namespace App\Http\Requests\Website;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdatedEmailRequest extends FormRequest
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
    {   $userId = auth()->user()->uuid;
        return [
            'email' => [
                'required',
                'max:255',
                Rule::unique('users')->ignore($userId, 'uuid'),
            ],
    
        
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'Vui lòng nhập email',
            'email.unique' => 'Email này đã tồn tại rồi',
            'email.email' => 'Đây không phải là email',
        ];
    }
}
