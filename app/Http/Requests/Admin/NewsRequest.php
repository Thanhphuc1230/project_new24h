<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
        $uuid = $this->route('uuid');
        $rules = [
            'title' => 'required|unique:news,title',
            'intro' => 'required|unique:news,intro',
            'content' => 'required|unique:news,content',
            'author' => 'required',
            'avatar' => $uuid ? 'nullable' : 'required', // Make "avatar" field optional
        ];
        
        // If we are updating an existing news item, we need to add the UUID to the unique rule
        if ($uuid) {
            $rules['title'] .= ",$uuid,uuid";
            $rules['intro'] .= ",$uuid,uuid";
            $rules['content'] .= ",$uuid,uuid";
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'title.required' => 'Vui lòng nhập tiêu đề cho bài viết',
            'title.unique' => 'Tiêu đề này đã tồn tại',
            'intro.required' => 'Vui lòng nhập phần giới thiệu cho bài viết',
            'intro.unique' => 'Phần giới thiệu này đã tồn tại',
            'content.required' => 'Vui lòng nhập nội dung cho bài viết',
            'content.unique' => 'Nội dung này đã tồn tại',
            'author.required' => 'Vui lòng nhập thông tin người đăng  bài viết',
            'avatar.required' => 'Vui lòng nhập hình đại diện của bài viết',
        ];
    }
}
