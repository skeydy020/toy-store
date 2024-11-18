<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\DoTuoi\DoTuoiService;
use Illuminate\Http\Request;
use App\Models\Dot;
use App\Models\DoTuoi;
use Illuminate\Support\Facades\Auth;

class DoTuoiController extends Controller
{
    protected $dotuoi;

    public function __construct(DoTuoiService $dotuoi)
    {
        $this->dotuoi = $dotuoi;
    }

    public function create()
    {   
        return view('admin.dotuoi.add', [
           'title' => 'Thêm thương hiệu mới'
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'thumb' => 'required',
        ]);

        $this->dotuoi->insert($request);

        return redirect('/admin/dotuois/list');
    }

    public function index()
    {      
        return view('admin.dotuoi.list', [
            'title' => 'Danh Sách Thương Hiệu Mới Nhất',
            'dotuois' => $this->dotuoi->get()
        ]);
        
        
    }

    public function show(DoTuoi $dotuoi)
    {     
        return view('admin.dotuoi.edit', [
            'title' => 'Chỉnh Sửa độ tuổi: ' ,
            'dotuoi' => $dotuoi
        ]);
        
       
    }

    public function update(Request $request, DoTuoi $dotuoi)
    {
        $this->validate($request, [
            'name' => 'required',
            'thumb' => 'required',
        ]);

        $result = $this->dotuoi->update($request, $dotuoi);
        if ($result) {
            return redirect('/admin/dotuois/list');
        }

        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $result = $this->dotuoi->destroy($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công dotuoi'
            ]);
        }

        return response()->json([ 'error' => true ]);
    }
}
