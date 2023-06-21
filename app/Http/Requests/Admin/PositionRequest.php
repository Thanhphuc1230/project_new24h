<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PositionRequest extends FormRequest
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
            'position' => request()->route('uuid') 
                    ? 'required|unique:staff_position,position,'.request()->route('uuid').',uuid'
                    : 'required|unique:staff_position',
        ];
    }

    public function messages()
    {
        return [
            'position.required' => 'Vui lòng nhập tên của chức vụ',
            'position.unique' => 'Chức vụ này đã tồn tại',
        ];
    }
}
