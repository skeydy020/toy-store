<?php

namespace App\Http\Services\DoTuoi;


use App\Models\DoTuoi;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class DoTuoiService
{
    public function insert($request)
    {
        try {
            #$request->except('_token');
            DoTuoi::create($request->input());
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
        return DoTuoi::orderByDesc('id')->paginate(15);
    }

    public function update($request, $dotuoi)
    {
        try {
            $dotuoi->fill($request->input());
            $dotuoi->save();
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
        $slider = DoTuoi::where('id', $request->input('id'))->first();
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
        return DoTuoi::where('active', 1)->get();
    }
}
