<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\DanhMucTin\DanhMucTinService;
use Illuminate\Http\Request;
use App\Models\Dot;
use App\Models\DanhMucTinTuc;
use Illuminate\Support\Facades\Auth;

class DanhMucTinController extends Controller
{
    protected $danhMucTinService;

    public function __construct(DanhMucTinService $danhMucTinService)
    {
        $this->danhMucTinService = $danhMucTinService;
    }

    public function create()
    {   
        return view('admin.danhmuctintuc.add', [
           'title' => 'Thêm danh mục tin tức mới'
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $this->danhMucTinService->insert($request);

        return redirect('/admin/danhmuctins/list');
    }

    public function index()
    {      
        return view('admin.danhmuctintuc.list', [
            'title' => 'Danh Sách Danh Mục Mới Nhất',
            'danhmuctins' => $this->danhMucTinService->get()
        ]);
        
        
    }

    public function show(DanhMucTinTuc $danhmuctin)
    {     
        return view('admin.danhmuctintuc.edit', [
            'title' => 'Chỉnh Sửa Danh Mục: ' ,
            'danhmuctin' => $danhmuctin
        ]);
        
       
    }

    public function update(Request $request, DanhMucTinTuc $danhmuctin)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $result = $this->danhMucTinService->update($request, $danhmuctin);
        if ($result) {
            return redirect('/admin/danhmuctins/list');
        }

        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $result = $this->danhMucTinService->destroy($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công danh mục tin'
            ]);
        }

        return response()->json([ 'error' => true ]);
    }
}
