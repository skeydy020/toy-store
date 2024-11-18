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
use Illuminate\Support\Facades\Session;

class GioHangService
{
    public function create($request)
    {
        $SoLuong = (int)$request->input('SoLuong');
        $sanpham_id = (int)$request->input('sanpham_id');

        if ($SoLuong <= 0 || $sanpham_id <= 0) {
            Session::flash('error', 'Số lượng hoặc Sản phẩm không chính xác');
            return false;
        }

        $GioHang = Session::get('GioHang');
        if (is_null($GioHang)) {
            Session::put('GioHang', [
                $sanpham_id => $SoLuong
            ]);
            return true;
        }

        $exists = Arr::exists($GioHang, $sanpham_id);
        if ($exists) {
            $GioHang[$sanpham_id] = $GioHang[$sanpham_id] + $SoLuong;
            Session::put('GioHang', $GioHang);
            return true;
        }

        $GioHang[$sanpham_id] = $SoLuong;
        Session::put('GioHang', $GioHang);

        return true;
    }
    public function homecreate($id)
    {
        $SoLuong = 1;
        $sanpham_id = $id;

        if ($sanpham_id <= 0) {
            Session::flash('error', 'Sản phẩm không chính xác');
            return false;
        }

        $GioHang = Session::get('GioHang');
        if (is_null($GioHang)) {
            Session::put('GioHang', [
                $sanpham_id => $SoLuong
            ]);
            return true;
        }

        $exists = Arr::exists($GioHang, $sanpham_id);
        if ($exists) {
            $GioHang[$sanpham_id] = $GioHang[$sanpham_id] + $SoLuong;
            Session::put('GioHang', $GioHang);
            return true;
        }

        $GioHang[$sanpham_id] = $SoLuong;
        Session::put('GioHang', $GioHang);

        return true;
    }

    public function getSanPham()
    {
        $GioHang = Session::get('GioHang');
        if (is_null($GioHang)) return [];

        $sanpham_id = array_keys($GioHang);
        return SanPham::select('id', 'name', 'Gia', 'GiamGia', 'thumb')
            ->where('active', 1)
            ->whereIn('id', $sanpham_id)
            ->get();
    }
    public function getPhuongThuc()
    {
        return PTThanhToan:: orderByDesc('id')->get();
    }
    public function update($request)
    {
        Session::put('GioHang', $request->input('SoLuong'));

        return true;
    }

    public function remove($id)
    {
        $GioHang = Session::get('GioHang');
        unset($GioHang[$id]);

        Session::put('GioHang', $GioHang);
        return true;
    }

    public function taoDonHang($request)
    {
        try {
            DB::beginTransaction();

            $GioHang = Session::get('GioHang');

            if (is_null($GioHang))
                return false;

            $donhang = DonHang::create([
                'user_id' => (int)Auth::id(),
                'pttt_id' => (int)$request->input('pttt_id'),
                'TenKH' => (string)$request->input('TenKH'),
                'DiaChiNhanHang' => (string)$request->input('DiaChiNhanHang'),
                'SDT' => (string)$request->input('SDT'),
                'GhiChu' => (string)$request->input('GhiChu'),
                'TongTien' => (double)$request->input('TongTien'),
                'TTDonHang' => (string)'Đơn hàng đã đặt'
            ]);
            
            $sanpham_id = array_keys($GioHang);

            $giaSanPham = SanPham::select('id', 'Gia', 'GiamGia')
                     ->where('active', 1)
                     ->whereIn('id', $sanpham_id)
                     ->get()
                     ->keyBy('id'); // Tạo mảng với key là id của sản phẩm
            foreach ($sanpham_id as $id) {
                $gia = $giaSanPham[$id];
                if($gia->GiamGia > 0){
                    ChiTietDonHang::create([
                        'donhang_id' => (int) $donhang->id,
                        'sanpham_id' =>  (int)$id,
                        'Gia' => (double)$gia->GiamGia,
                        'SoLuong' =>  (int)$GioHang[$id]
                    ]);}
                else{
                ChiTietDonHang::create([
                    'donhang_id' => (int) $donhang->id,
                    'sanpham_id' =>  (int)$id,
                    'Gia' => (double)$gia->Gia,
                    'SoLuong' =>  (int)$GioHang[$id]
                ]);}
            }
            // $this->infoProductCart($GioHang, $donhang->id);

            DB::commit();
            Session::flash('success', 'Đặt Hàng Thành Công');

            #Queue
            // SendMail::dispatch($request->input('email'))->delay(now()->addSeconds(2));

            Session::forget('GioHang');

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
        return DonHang::orderByDesc('id')->paginate(15);
    }

    public function getProductForCart($customer)
    {
        return $customer->carts()->with(['product' => function ($query) {
            $query->select('id', 'name', 'thumb');
        }])->get();
    }
}
