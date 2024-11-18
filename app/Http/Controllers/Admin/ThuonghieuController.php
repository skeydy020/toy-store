<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Thuonghieu\ThuonghieuService;
use Illuminate\Http\Request;
use App\Models\ThuongHieu;
use Illuminate\Support\Facades\Auth;

class ThuonghieuController extends Controller
{
    protected $thuonghieu;

    public function __construct(ThuonghieuService $thuonghieu)
    {
        $this->thuonghieu = $thuonghieu;
    }

    public function create()
    {   
        return view('admin.thuonghieu.add', [
           'title' => 'Thêm thương hiệu mới'
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'thumb' => 'required',
        ]);

        $this->thuonghieu->insert($request);

        return redirect('/admin/thuonghieus/list');
    }

    public function index()
    {      
        return view('admin.thuonghieu.list', [
            'title' => 'Danh Sách Thương Hiệu Mới Nhất',
            'thuonghieus' => $this->thuonghieu->get()
        ]);
        
        
    }

    public function show(Thuonghieu $thuonghieu)
    {     
        return view('admin.thuonghieu.edit', [
            'title' => 'Chỉnh Sửa thuonghieu: ' . $thuonghieu->name,
            'thuonghieu' => $thuonghieu
        ]);
        
       
    }

    public function update(Request $request, Thuonghieu $thuonghieu)
    {
        $this->validate($request, [
            'name' => 'required',
            'thumb' => 'required',
        ]);

        $result = $this->thuonghieu->update($request, $thuonghieu);
        if ($result) {
            return redirect('/admin/thuonghieus/list');
        }

        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $result = $this->thuonghieu->destroy($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công thuonghieu'
            ]);
        }

        return response()->json([ 'error' => true ]);
    }
}
