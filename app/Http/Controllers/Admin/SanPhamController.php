<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SanPham\SanPhamRequest;
use App\Http\Requests\Song\SongRequest;
use App\Http\Services\SanPham\SanPhamService;
use App\Http\Services\Song\SongAdminService;
use App\Models\SanPham;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class SanPhamController extends Controller
{
    protected $SanPhamService;

    public function __construct(SanPhamService $SanPhamService)
    {
        $this->SanPhamService = $SanPhamService;
    }

    public function index()
    {    
        return view('admin.sanpham.list', [
            'title' => 'Danh Sách Sản Phẩm',
            'sanphams' => $this->SanPhamService->get()
        ]);
        
    }

    public function create()
    {    
        return view('admin.sanpham.add', [
            'title' => 'Thêm sản phẩm Mới',
            'menus' => $this->SanPhamService->getMenu(),
            'dotuois' => $this->SanPhamService->getDoTuoi(),
            'xuatxus' => $this->SanPhamService->getXuatXu(),
            'gioitinhs' => $this->SanPhamService->getGioiTinh(),
            'thuonghieus' => $this->SanPhamService->getThuongHieu()
        ]);
    }


    public function store(SanPhamRequest $request)
    {
        $this->SanPhamService->insert($request);

        return redirect()->back();
    }

    public function show(SanPham $sanpham)
    {   
        return view('admin.sanpham.edit', [
            'title' => 'Chỉnh Sửa Sản Phẩm: ' . $sanpham->name,
            'sanpham' => $sanpham,
            'menus' => $this->SanPhamService->getMenu(),
            'dotuois' => $this->SanPhamService->getDoTuoi(),
            'xuatxus' => $this->SanPhamService->getXuatXu(),
            'gioitinhs' => $this->SanPhamService->getGioiTinh(),
            'thuonghieus' => $this->SanPhamService->getThuongHieu()
        ]);
        
    }


    public function update(Request $request, SanPham $sanpham)
    {
        $result = $this->SanPhamService->update($request, $sanpham);
        if ($result) {
            return redirect('/admin/sanphams/list');
        }

        return redirect()->back();
    }


    public function destroy(Request $request)
    {
        $result = $this->SanPhamService->delete($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công bài hát'
            ]);
        }

        return response()->json([ 'error' => true ]);
    }
}
