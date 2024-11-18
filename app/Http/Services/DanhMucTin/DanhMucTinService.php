<?php

namespace App\Http\Services\DanhMucTin;


use App\Models\DanhMucTinTuc;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class DanhMucTinService
{
    public function insert($request)
    {
        try {
            #$request->except('_token');
            DanhMucTinTuc::create($request->input());
            Session::flash('success', 'Thêm mới thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Thêm LỖI');
            Log::info($err->getMessage());

            return false;
        }

        return true;
    }

    public function get()
    {
        return DanhMucTinTuc::orderByDesc('id')->paginate(15);
    }

    public function getAll()
    {
        return DanhMucTinTuc::orderBy('name')->get();
    }

    public function update($request, $danhmuctin)
    {
        try {
            $danhmuctin->fill($request->input());
            $danhmuctin->save();
            Session::flash('success', 'Cập nhật thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Cập nhật Lỗi');
            Log::info($err->getMessage());

            return false;
        }

        return true;
    }

    public function destroy($request)
    {
        $slider = DanhMucTinTuc::where('id', $request->input('id'))->first();
        if ($slider) {
       
            $slider->delete();
            return true;
        }

        return false;
    }

    public function show()
    {
        return DanhMucTinTuc::where('active', 1)->get();
    }
}