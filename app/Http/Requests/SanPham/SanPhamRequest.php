<?php

namespace App\Http\Requests\SanPham;

use Illuminate\Foundation\Http\FormRequest;

class SanPhamRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'thumb' => 'required',
            'Code' => 'required',
            'Gia' => 'required',
            'description' => 'required',    
            'menu_id' => 'required',
            'dotuoi_id' => 'required',
            'thuonghieu_id' => 'required',
            'xuatxu_id' => 'required',
            'SoLuong' => 'required',
            'content' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên sản phẩm',
            'thumb.required' => 'Ảnh đại diện không được trống',
            'Code.required' => 'Code không được trống',
            'Gia.required' => 'Giá không được trống',
            'description.required' => 'Mô tả không được trống',
            'menu_id.required' => 'Mô tả không được trống',
            'thuonghieu_id.required' => 'Mô tả không được trống',
            'xuatxu_id.required' => 'Mô tả không được trống',
            'dotuoi_id.required' => 'Mô tả không được trống',
            'SoLuong.required' => 'Số lượng không được trống',
            'content.required' => 'Nội dung không được trống'
        ];
    }
}
