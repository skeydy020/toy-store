<?php

namespace App\Http\Requests\Menu;

use Illuminate\Foundation\Http\FormRequest;

class CreateFormRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required',
            'content' => 'required'
        ];

    }
    public function messages():array
    {
        return  [
            'name.required' => 'vui lòng nhập tên danh mục',
            'description.required' => 'vui lòng nhập mô tả',
            'content.required' => 'vui lòng nhập nội dung'
        ];
    }


}
