<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\TinTuc\TinTucService;
use Illuminate\Http\Request;
use App\Models\TinTuc;
use Illuminate\Support\Facades\Auth;

class TinTucController extends Controller
{
    protected $tintucService;

    public function __construct(TinTucService $tintucService)
    {
        $this->tintucService = $tintucService;
    }

    public function create()
    {   
        return view('admin.tintuc.add', [
           'title' => 'Thêm tin mới',
           'danhmuctins' => $this->tintucService->getDMTinTuc()
        ]);
        
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'danhmuc_id' => 'required',
            'name' => 'required',
            'thumb' => 'required',
            'description' => 'required',
            'content' => 'required',
        ]);

        $this->tintucService->insert($request);

        return redirect()->back();
    }

    public function index()
    {      
        return view('admin.tintuc.list', [
            'title' => 'Danh Sách tin tức ',
            'tintucs' => $this->tintucService->get(),

        ]);
        
        
    }

    public function show(TinTuc $tintuc)
    {     
        return view('admin.tintuc.edit', [
            'title' => 'Chỉnh Sửa tin tức: ' . $tintuc->name,
            'tintuc' => $tintuc,
            'danhmuctins' => $this->tintucService->getDMTinTuc()
        ]);
        
       
    }

    public function update(Request $request, TinTuc $tintuc)
    {
        $this->validate($request, [
            'danhmuc_id' => 'required',
            'name' => 'required',
            'thumb' => 'required',
            'description' => 'required',
            'content' => 'required',
        ]);

        $result = $this->tintucService->update($request, $tintuc);
        if ($result) {
            return redirect('/admin/tintucs/list');
        }

        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $result = $this->tintucService->destroy($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công tin tức'
            ]);
        }

        return response()->json([ 'error' => true ]);
    }
}
