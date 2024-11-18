<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Services\GioHangService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class GioHangController extends Controller
{
    protected $GioHangService;

    public function __construct(GioHangService $GioHangService)
    {
        $this->GioHangService = $GioHangService;
    }

    public function index(Request $request)
    {
        $result = $this->GioHangService->create($request);
        if ($result === false) {
            return redirect()->back();
        }

        return redirect('/carts');
    }

    public function show()
    {
        $sanphams = $this->GioHangService->getSanPham();
        $thanhtoans = $this->GioHangService->getPhuongThuc();
        return view('giohang.list', [
            'title' => 'Giỏ Hàng ',
            'sanphams' => $sanphams,
            'sanphamgiohangs' => $sanphams,
            'thanhtoans' => $thanhtoans,
            'GioHang' => Session::get('GioHang')
        ]);
    }

    public function update(Request $request)
    {
        $this->GioHangService->update($request);

        return redirect('/carts');
    }

    public function remove($id = 0)
    {
        $this->GioHangService->remove($id);

        return redirect('/carts');
    }

    public function addCart(Request $request)
    {   
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Bạn cần đăng nhập để thực hiện chức năng này');
        }
        $this->GioHangService->taoDonHang($request);

        return redirect()->back();
    }
    public function addCartHome($id = 0)
    {   
        $result = $this->GioHangService->homecreate($id);
        if ($result === false) {
            return redirect()->back();
        }
        return redirect()->back();
    }
    
}
