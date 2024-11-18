<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\User\UserService;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function create()
    {   
        return view('admin.user.add', [
           'title' => 'Thêm người dùng mới'
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $this->userService->insert($request);

        return redirect('/admin/users/list');
    }

    public function index()
    {      
        return view('admin.user.list', [
            'title' => 'Danh Sách Người Dùng',
            'users' => $this->userService->get()
        ]);
        
        
    }

    public function show(User $user)
    {     
        return view('admin.user.edit', [
            'title' => 'Chỉnh Sửa Danh Mục: ' ,
            'user' => $user
        ]);
        
       
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $result = $this->userService->update($request, $user);
        if ($result) {
            return redirect('/admin/users/list');
        }

        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $result = $this->userService->destroy($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công danh mục tin'
            ]);
        }

        return response()->json([ 'error' => true ]);
    }
}
