<?php

namespace App\Http\Services\Thuonghieu;


use App\Models\ThuongHieu;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ThuonghieuService
{
    public function insert($request)
    {
        try {
            #$request->except('_token');
            ThuongHieu::create($request->input());
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
        return ThuongHieu::orderByDesc('updated_at')->paginate(15);
    }

    public function getAll()
    {
        return ThuongHieu::orderBy(column: 'name')->get();
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
        $slider = ThuongHieu::where('id', $request->input('id'))->first();
        if ($slider) {
            $path = str_replace('storage', 'public', $slider->thumb);
            Storage::delete($path);
            $slider->delete();
            return true;
        }

        return false;
    }

    public function show()
    {
        return ThuongHieu::where('active', 1)->get();
    }
}