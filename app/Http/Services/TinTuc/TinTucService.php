<?php

namespace App\Http\Services\TinTuc;

use App\Models\DanhMucTinTuc;
use App\Models\TinTuc;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class TinTucService
{   
 
    public function getDMTinTuc()
    {
        return DanhMucTinTuc::where('active', 1)->get();
    }

    public function getByDMTinTucId($danhmucid)
    {
        return TinTuc::where('active', 1)
                    ->where('danhmuc_id', $danhmucid)
                    ->orderByDesc('id')
                    ->paginate(8);
    }

    public function getById($id)
    {
        return TinTuc::where('active', 1)
                    ->where('id', $id)
                    ->get()
                    ->first();
    }

    public function get()
    {
        return TinTuc::where('active', 1)
                    ->orderByDesc('updated_at')
                    ->paginate(8);
    }

    public function insert($request)
    {
        try {
            $request->except('_token');
            
            TinTuc::create([
                'name' => (string)$request->input('name'),
                'thumb' => (string)$request->input('thumb'),
                'description' => (string)$request->input('description'),
                'user_id' =>Auth::id(),
                'danhmuc_id' => (int)$request->input('danhmuc_id'),
                'content' => (string)$request->input('content'),
                'active' => (string)$request->input('active')
              
            ]);
            Session::flash('success', 'Thêm tin mới thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Thêm tin LỖI');
            Log::info($err->getMessage());

            return false;
        }

        return true;
    }

    public function update($request, $tintuc)
    {
        try {
            $tintuc->fill($request->input());
            $tintuc->save();
            Session::flash('success', 'Cập nhật tin tức thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Cập nhật tin tức Lỗi');
            Log::info($err->getMessage());

            return false;
        }

        return true;
    }

    public function destroy($request)
    {
        $tintuc = TinTuc::where('id', $request->input('id'))->first();
        if ($tintuc) {
            $path = str_replace('storage', 'public', $tintuc->thumb);
            Storage::delete($path);
            $tintuc->delete();
            return true;
        }

        return false;
    }

    public function show()
    {
        return TinTuc::where('active', 1)->orderByDesc('id')->get();
    }
}