<?php

namespace App\Http\Controllers;

use App\Http\Services\DonHangService;
use App\Http\Services\GioHangService;
use App\Http\Services\User\UserService;
use App\Models\DonHang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

use function PHPUnit\Framework\isNull;

class TaiKhoanController extends Controller
{
    protected $userservice;
    protected $donhangservice;
    protected $giohang;
    public function __construct(UserService $userservice, DonHangService $donhangservice,GioHangService $giohang)
    {
        $this->userservice = $userservice;
        $this->donhangservice = $donhangservice;
        $this->giohang = $giohang;
    }
    public function index()
    {
        if (Auth::check()) {
            // Nếu người dùng đã đăng nhập
            
            return view('user.taikhoan', [
                'title' => 'Tài khoản ',
                'sanphamgiohangs' => $this->giohang->getSanPham(),
                'user' => $this->userservice->show(Auth::id()),
            ]);
        } else {
            // Nếu người dùng chưa đăng nhập
            return redirect()->route('login');
        }

    }
    public function lichsu()
    {
        
            // Nếu người dùng đã đăng nhập
        return view('user.lichsumuahang', [
            'title' => 'Tài khoản ',
            'sanphamgiohangs' => $this->giohang->getSanPham(),
            'donhangs' => $this->donhangservice->getDonHangnguoidung(Auth::id()),
        ]);
        

    }
    public function logout()
    {
        Auth::logout();  // Đăng xuất người dùng

        return redirect()->route('home');;  // Điều hướng về trang đăng nhập
    }
    public function change()
    {
        
            // Nếu người dùng đã đăng nhập
        return view('user.doimatkhau', [
            'title' => 'Đổi mật khẩu ',
            'sanphamgiohangs' => $this->giohang->getSanPham()
        ]);
        

    }
    public function store(Request $request){
        
        if(((String)$request->input('password')) != ((String)$request->input('confirm-password')))
        {   Session::flash('error','Mật khẩu nhập lại không trùng khớp');
            return redirect()->back();
        }
        if (!Hash::check($request->oldpassword, Auth::user()->password)) {
            Session::flash('error','Mật khẩu hiện tại sai');
            return redirect()->back();
        }
       
        try {
            $user = User::find(Auth::id()); // Tìm người dùng theo ID
            if ($user) {
                $user->password = bcrypt($request->input('password')); // Gán dữ liệu mới từ mảng $data
                $user->save();  }
        } catch (\Exception $err) {
            Session::flash('error', 'Dổi mật khẩu Lỗi');
            Log::info($err->getMessage());

            return redirect()->back();
        }
        return redirect()->back()->with('status', 'Đổi mật khẩu thành công!');
        
       }
    public function show(DonHang $donhang)
    {
        
        $Chitiets = $this->donhangservice->getProductForCart($donhang);

        return view('user.donhang', [
            'title' => 'Chi Tiết Đơn Hàng: ' . $donhang->name,
            'donhang' => $donhang,
            'sanphamgiohangs' => $this->giohang->getSanPham(),
            'Chitiets' => $Chitiets
        ]);

    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
        ]);

        $result = $this->userservice->webupdate($request, Auth::id());
        return redirect()->back();
    }
    
}
