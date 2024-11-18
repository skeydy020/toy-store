<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Services\GioHangService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\BinaryOp\Equal;

class RegisterController extends Controller
{   
    protected $giohang;
    public function __construct(GioHangService $giohang)
    {
        $this->giohang = $giohang;
    }
   public function index(){
    return view('admin.users.register',['title'=>   'Đăng ký tài khoản',
    'sanphamgiohangs' => $this->giohang->getSanPham()]);

   }
   public function store(Request $request){
    if(((String)$request->input('password')) != ((String)$request->input('confirm-password')))
    {   Session::flash('error','Password nhập lại không trùng khớp');
        return redirect()->back();
    }
   
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->SDT = $request->input('SDT');
        $user->GioiTinh = $request->input('GioiTinh');
        $user->password = bcrypt($request->input('password'));

        $user->save();
        return redirect()->route('login');
    
   }
}
