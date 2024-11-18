<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\GioiTinh\GioiTinhService;
use Illuminate\Http\Request;
use App\Models\GioiTinh;
use Illuminate\Support\Facades\Auth;

class GioiTinhController extends Controller
{
    protected $gioitinh;

    public function __construct(GioiTinhService $gioitinh)
    {
        $this->gioitinh = $gioitinh;
    }

    public function create()
    {   
        return view('admin.gioitinh.add', [
           'title' => 'Thêm thương hiệu mới'
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $this->gioitinh->insert($request);

        return redirect('/admin/gioitinhs/list');
    }

    public function index()
    {      
        return view('admin.gioitinh.list', [
            'title' => 'Danh Sách Thương Hiệu Mới Nhất',
            'gioitinhs' => $this->gioitinh->get()
        ]);
        
        
    }

    public function show(GioiTinh $gioitinh)
    {     
        return view('admin.gioitinh.edit', [
            'title' => 'Chỉnh Sửa gioitinh: ' . $gioitinh->name,
            'gioitinh' => $gioitinh
        ]);
        
       
    }

    public function update(Request $request, GioiTinh $gioitinh)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $result = $this->gioitinh->update($request, $gioitinh);
        if ($result) {
            return redirect('/admin/gioitinhs/list');
        }

        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $result = $this->gioitinh->destroy($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công gioitinh'
            ]);
        }

        return response()->json([ 'error' => true ]);
    }
}
