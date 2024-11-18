<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Anh\AnhService;
use App\Models\SanPham;
use Illuminate\Http\Request;
use App\Models\ThuVienAnh;
use Illuminate\Support\Facades\Auth;

class AnhController extends Controller
{
    protected $anhService;

    public function __construct(AnhService $anhService)
    {
        $this->anhService = $anhService;
    }

    public function create()
    {   
        return view('admin.anh.add', [
           'title' => 'Thêm ảnh mới',
           'sanphams' => $this->anhService->getSanPham()
        ]);
        
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'sanpham_id' => 'required',
            'thumb' => 'required',
        ]);

        $this->anhService->insert($request);

        return redirect('/admin/anhs/list');
    }
    public function store2(Request $request,SanPham $sanpham)
    {
        $this->validate($request, [
            'thumb' => 'required',
        ]);

        $this->anhService->insert2($request,$sanpham);

        return redirect()->back();
    }

    public function index()
    {      
        return view('admin.anh.list', [
            'title' => 'Danh Sách ảnh ',
            'anhs' => $this->anhService->get()
        ]);
        
        
    }
    public function sanpham(SanPham $sanpham)
    {      
        return view('admin.anh.list2', [
            'title' => 'Danh Sách ảnh '. $sanpham->name,
            'anhs' => $this->anhService->getanh($sanpham),
            'id' => $sanpham->id
        ]);
        
        
    }


    public function show(ThuVienAnh $anh)
    {     
        return view('admin.anh.edit', [
            'title' => 'Chỉnh Sửa Slider: ' . $anh->name,
            'anh' => $anh
        ]);
        
       
    }

    public function update(Request $request, ThuVienAnh $anh)
    {
        $this->validate($request, [
            'sanpham_id' => 'required',
            'thumb' => 'required',
        ]);

        $result = $this->anhService->update($request, $anh);
        if ($result) {
            return redirect('/admin/anhs/list');
        }

        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $result = $this->anhService->destroy($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công ảnh'
            ]);
        }

        return response()->json([ 'error' => true ]);
    }
}
