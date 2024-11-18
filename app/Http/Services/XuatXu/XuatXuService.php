<?php

namespace App\Http\Services\XuatXu;


use App\Models\XuatXu;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class XuatXuService
{
    public function insert($request)
    {
        try {
            #$request->except('_token');
            XuatXu::create($request->input());
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
        return XuatXu::orderByDesc('id')->paginate(15);
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
        $slider = XuatXu::where('id', $request->input('id'))->first();
        if ($slider) {
            $slider->delete();
            return true;
        }

        return false;
    }

    public function show()
    {
        return XuatXu::where('active', 1)->get();
    }
}
