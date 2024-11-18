<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Services\GioHangService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DonHangController extends Controller
{
   
   

    public function index()
    {
       
        return view('donhang', [
            'title' => 'Đơn Hàng ',
            
            
        ]);
    }

    
    
}
