<?php

namespace App\Http\Services\GioiTinh;


use App\Models\GioiTinh;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class GioiTinhService
{
    public function insert($request)
    {
        try {
            #$request->except('_token');
            GioiTinh::create($request->input());
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
        return GioiTinh::orderByDesc('id')->paginate(15);
    }

    public function update($request, $slider)
    {
        try {
            $slider->fill($request->input());
            $slider->save();
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
        $slider = GioiTinh::where('id', $request->input('id'))->first();
        if ($slider) {
            $slider->delete();
            return true;
        }

        return false;
    }

    public function show()
    {
        return GioiTinh::where('active', 1)->get();
    }
}
