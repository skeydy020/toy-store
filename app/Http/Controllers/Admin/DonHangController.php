<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\DonHangService;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Services\GioHangService;
use App\Models\DonHang;

class DonHangController extends Controller
{
    protected $donhang;
    public function __construct(DonHangService $donhang)
    {
        $this->donhang = $donhang;
    }

    public function index()
    {
        return view('admin.donhang.list', [
            'title' => 'Danh Sách Đơn Đặt Hàng',
            'donhangs' => $this->donhang->getDonHang()
        ]);
    }

    public function show(DonHang $donhang)
    {
        $Chitiets = $this->donhang->getProductForCart($donhang);

        return view('admin.donhang.detail', [
            'title' => 'Chi Tiết Đơn Hàng: ' . $donhang->name,
            'donhang' => $donhang,
            'Chitiets' => $Chitiets
        ]);
    }
    public function edit(DonHang $donhang)
    {     
        return view('admin.donhang.edit', [
            'title' => 'Chỉnh Sửa Trạng Thái Đơn Hàng: ' . $donhang->id
        ]);
        
       
    }

    public function update(Request $request, DonHang $donhang)
    {
        

        $result = $this->donhang->update($request, $donhang);
        if ($result) {
            return redirect('/admin/donhangs');
        }

        return redirect()->back();
    }
    public function destroy(Request $request)
    {
        $result = $this->donhang->delete($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công đơn hàng'
            ]);
        }

        return response()->json([ 'error' => true ]);
    }
}
