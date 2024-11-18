<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\XuatXu\XuatXuService;
use Illuminate\Http\Request;
use App\Models\XuatXu;
use Illuminate\Support\Facades\Auth;

class XuatXuController extends Controller
{
    protected $xuatxu;

    public function __construct(XuatXuService $xuatxu)
    {
        $this->xuatxu = $xuatxu;
    }

    public function create()
    {   
        return view('admin.xuatxu.add', [
           'title' => 'Thêm thương hiệu mới'
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ]);

        $this->xuatxu->insert($request);

        return redirect('/admin/xuatxus/list');
    }

    public function index()
    {      
        return view('admin.xuatxu.list', [
            'title' => 'Danh Sách Thương Hiệu Mới Nhất',
            'xuatxus' => $this->xuatxu->get()
        ]);
        
        
    }

    public function show(XuatXu $xuatxu)
    {     
        return view('admin.xuatxu.edit', [
            'title' => 'Chỉnh Sửa xuất xứ: ' . $xuatxu->name,
            'xuatxu' => $xuatxu
        ]);
        
       
    }

    public function update(Request $request, XuatXu $xuatxu)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ]);

        $result = $this->xuatxu->update($request, $xuatxu);
        if ($result) {
            return redirect('/admin/xuatxus/list');
        }

        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $result = $this->xuatxu->destroy($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công!'
            ]);
        }

        return response()->json([ 'error' => true ]);
    }
}
