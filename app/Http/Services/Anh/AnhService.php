<?php

namespace App\Http\Services\Anh;

use App\Models\SanPham;
use App\Models\ThuVienAnh;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AnhService
{   
    public function getSanPham()
    {
        return SanPham::where('active', 1)->get();
    }
    
    public function insert($request)
    {
        try {
            #$request->except('_token');
            ThuVienAnh::create($request->input());
            Session::flash('success', 'Thêm ảnh mới thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Thêm Ảnh LỖI');
            Log::info($err->getMessage());

            return false;
        }

        return true;
    }
    public function insert2($request,SanPham $sanpham)
    {
        try {
          
            #$request->except('_token');
            $request->except('_token');
            // Album::create($request->all());
            ThuVienAnh::create([
                'thumb' => (string)$request->input('thumb'),
                'sanpham_id' => (int)$sanpham->id,
                'active' => (string)$request->input('active')
              
            ]);
            Session::flash('success', 'Thêm ảnh mới thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Thêm Ảnh LỖI');
            Log::info($err->getMessage());

            return false;
        }

        return true;
    }
    public function get()
    {
        return ThuVienAnh::with('SanPham')->
        orderByDesc('id')->paginate(15);
    }
    public function getanh(SanPham $sanPham)
    {
        return ThuVienAnh::where('sanpham_id', $sanPham->id)
        ->orderByDesc('id')
        ->paginate(15);
    }

    public function update($request, $anh)
    {
        try {
            $anh->fill($request->input());
            $anh->save();
            Session::flash('success', 'Cập nhật ảnh thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Cập nhật ảnh Lỗi');
            Log::info($err->getMessage());

            return false;
        }

        return true;
    }

    public function destroy($request)
    {
        $anh = ThuVienAnh::where('id', $request->input('id'))->first();
        if ($anh) {
            $path = str_replace('storage', 'public', $anh->thumb);
            Storage::delete($path);
            $anh->delete();
            return true;
        }

        return false;
    }
    public function show($id)
    {
        return ThuVienAnh::where('sanpham_id', $id)
            ->where('active', 1)->get();
    }
   
}
