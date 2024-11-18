<?php


namespace App\Http\Services;


use App\Jobs\SendMail;
use App\Models\Cart;
use App\Models\ChiTietDonHang;
use App\Models\DonHang;
use App\Models\PTThanhToan;
use App\Models\SanPham;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class DonHangService
{       
    public function taoDonHang($request)
    {
        try {
            DB::beginTransaction();

            $GioHang = Session::get('GioHang');

            if (is_null($GioHang))
                return false;

            $donhang = DonHang::create([
                'user_id' => Auth::id(),
                'pttt_id' => $request->input('pttt_id'),
                'TenKH' => $request->input('TenKH'),
                'DiaChiNhanHang' => $request->input('DiaChiNhanHang'),
                'SDT' => $request->input('SDT'),
                'GhiChu' => $request->input('GhiChu'),
                'TongTien' => $request->input('TongTien')
            ]);
            
            $sanpham_id = array_keys($GioHang);

            foreach ($sanpham_id as $id) {
                $gia = SanPham::select('Gia', 'GiamGia')
                ->where('active', 1)
                ->where('id', $id)
                ->first();
                ChiTietDonHang::create([
                    'donhang_id' => $donhang->id,
                    'sanpham_id' => $id,
                    'Gia' => $gia,
                    'SoLuong' => $GioHang[$id]
                ]);
            }
            // $this->infoProductCart($GioHang, $donhang->id);

            DB::commit();
            Session::flash('success', 'Đặt Hàng Thành Công');

            #Queue
            // SendMail::dispatch($request->input('email'))->delay(now()->addSeconds(2));

         
        } catch (\Exception $err) {
            DB::rollBack();
            Session::flash('error', 'Đặt Hàng Lỗi, Vui lòng thử lại sau');
            return false;
        }

        return true;
    }

    protected function infoProductCart($GioHang, $donhang_id)
    {
        $sanpham_id = array_keys($GioHang);
        $sanphams = SanPham::select('id', 'name', 'Gia', 'GiamGia', 'thumb')
            ->where('active', 1)
            ->whereIn('id', $sanpham_id)
            ->get();

        $data = [];
        foreach ($sanphams as $sanpham) {
            $data[] = [
                'donhang_id' => $donhang_id,
                'product_id' => $sanpham->id,
                'pty'   => $GioHang[$sanpham->id],
                'price' => $sanpham->price_sale != 0 ? $sanpham->price_sale : $sanpham->price
            ];
        }

        return DonHang::insert($data);
    }

    public function getDonHang()
    {
        return DonHang::with('NguoiDung','PTTT')->
        orderByDesc('id')->paginate(15);
    }
    public function getDonHangnguoidung($id)
    {
        return DonHang::where('user_id',$id)->
        orderByDesc('id')->get();
    }
    public function getProductForCart($donhang)
    {
        return $donhang->ChiTietDonHang()->with(['SanPham' => function ($query) {
            $query->select('id', 'name', 'thumb');
        }])->get();
    }
    public function update($request, $donhang)
    {
        try {
            $request->except('_token');
            // Album::create($request->all());
            $donhang->update([
                'TTDonHang' => (string)$request->input('TTDonHang')
              
            ]);
            Session::flash('success', 'Cập nhật thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Cập nhật Lỗi');
            Log::info($err->getMessage());

            return false;
        }

        return true;
    }
    public function delete($request)
    {
        $donhang = DonHang::where('id', $request->input('id'))->first();
        if ($donhang) {
            $donhang->delete();
            return true;
        }

        return false;
    }
}
