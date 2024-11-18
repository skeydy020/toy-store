<?php


namespace App\Http\Services\SanPham;


use App\Models\SanPham;
use App\Models\DoTuoi;
use App\Models\Menu;
use App\Models\XuatXu;
use App\Models\GioiTinh;
use App\Models\ThuongHieu;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Ramsey\Uuid\Type\Integer;

class SanPhamService
{
    public function getMenu()
    {
        return Menu::where('active', 1)->get();
    }
    public function getDoTuoi()
    {
        return DoTuoi::where('active', 1)->get();
    }   
    public function getGioiTinh()
    {
        return GioiTinh::where('active', 1)->get();
    }  
    public function getThuongHieu()
    {
        return ThuongHieu::where('active', 1)->get();
    }    
    public function getXuatXu()
    {
        return XuatXu::where('active', 1)->get();
    }   
    protected function isValidPrice($request)
    {
        if ($request->input('Gia') != 0 && $request->input('GiamGia') != 0
            && $request->input('GiamGia') >= $request->input('Gia')
        ) {
            Session::flash('error', 'Giá giảm phải nhỏ hơn giá gốc');
            return false;
        }

        if ($request->input('GiamGia') != 0 && (int)$request->input('Gia') == 0) {
            Session::flash('error', 'Vui lòng nhập giá gốc');
            return false;
        }

        return  true;
    }

    public function insert($request)
    {
       //dd($request->input());
        $isValidPrice = $this->isValidPrice($request);
        if ($isValidPrice === false) return false;

        try {
            $request->except('_token');
            // Album::create($request->all());
            SanPham::create([
                'Code' => (string)$request->input('Code'),
                'name' => (string)$request->input('name'),
                'thumb' => (string)$request->input('thumb'),
                'description' => (string)$request->input('description'),
                'Gia' => (double)$request->input('Gia'),
                'GiamGia' => (double)$request->input('GiamGia'),
                'dotuoi_id' =>(int)$request->input('dotuoi_id'),
                'xuatxu_id' =>(int)$request->input('xuatxu_id'),
                'menu_id' => (int)$request->input('menu_id'),
                'thuonghieu_id' => (int)$request->input('thuonghieu_id'),
                'gioitinh_id' => (int)$request->input('gioitinh_id'),
                'SoLuong' => (int)$request->input('SoLuong'),
                'content' => (string)$request->input('content'),
                'active' => (string)$request->input('active')
              
            ]);

            Session::flash('success', 'Thêm sản phẩm thành công');
        } catch (\Exception $err) {

            Session::flash('error', $err->getMessage());
            Log::info($err->getMessage());
            return  false;
        }

        return  true;
    }

    public function get()
    {
        return SanPham::with('XuatXu','GioiTinh','DanhMuc','DoTuoi','ThuongHieu')
            ->orderByDesc('id')->paginate(12);
    }
    public function getgiamgia()
    {
        return SanPham::with('XuatXu','GioiTinh','DanhMuc','DoTuoi','ThuongHieu')
        ->where('GiamGia', '>', 0)
            ->orderByDesc('id')->paginate(12);
    }

    public function update($request, $sanpham)
    {
        $isValidPrice = $this->isValidPrice($request);
        if ($isValidPrice === false) return false;

        try {
            $sanpham->fill($request->input());
            $sanpham->save();
            Session::flash('success', 'Cập nhật thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Có lỗi vui lòng thử lại');
            Log::info($err->getMessage());
            
            return false;
        }
        return true;
    }

    public function delete($request)
    {
        $song = SanPham::where('id', $request->input('id'))->first();
        if ($song) {
            $song->delete();
            return true;
        }

        return false;
    }
}
