<?php

namespace App\Http\Controllers;

use App\Http\Services\GioHangService;
use Illuminate\Http\Request;
use App\Http\Services\Slider\SliderService;
use App\Http\Services\Menu\MenuService;
use App\Http\Services\SanPham\SanPhamService;
use App\Http\Services\Thuonghieu\ThuonghieuService;
use App\Http\Services\TinTuc\TinTucService;
use App\Models\Menu;
use App\Models\SanPham;
use Illuminate\Support\Str;

class MainController extends Controller
{
    protected $slider;
    protected $menu;
    protected $sanpham;
    protected $thuonghieu;
    protected $tintuc;
    protected $giohang;
    public function __construct(SliderService $slider, MenuService $menu,
        SanPhamService $sanpham, ThuonghieuService $thuonghieu,TinTucService $tintuc,
        GioHangService $giohang)
    {
        $this->slider = $slider;
        $this->menu = $menu;
        $this->sanpham = $sanpham;
        $this->thuonghieu = $thuonghieu;
        $this->tintuc = $tintuc;
        $this->giohang = $giohang;
    }
   
    public function index()
    {   
        
        return view('home', [
            'title' => 'Shop Đồ Chơi',
            'sliders' => $this->slider->show(),
            'menus' => $this->menu->show4(),   
            'thuonghieus' => $this->thuonghieu->show(),  
            'tintucs' => $this->tintuc->show(),  
            'sanphams' => $this->sanpham->get(),
            'sanphamgiohangs' => $this->giohang->getSanPham(),
            
            'sanphamgiamgias' => $this->sanpham->getgiamgia()
        ]);
    }
    public function Searchautocomplate(Request $request) {
        $query = $request->get('term', '');
        $productsQuery = SanPham::where('name', 'LIKE', '%' . $query . '%')
            ->orWhere('Code', 'LIKE', '%' . $query . '%')
            ->where('active', '1');

        // Đếm tổng số sản phẩm tìm được
        $totalProducts = $productsQuery->count();

        // Lấy tối đa 5 sản phẩm để hiển thị
        $products = $productsQuery->take(5)->get();

        $data = [
            'total' => $totalProducts, // Số lượng sản phẩm tìm được
            'products' => []
        ];

        foreach ($products as $item) {
            $data['products'][] = [
                'value' => $item->name, 
                'id' => $item->id,
                'Gia' => $item->Gia,
                'GiamGia' => $item->GiamGia,
                'thumb' => $item->thumb 
            ];
        }

        if (count($data)) {
            return $data;
        } else {
            return [['value' => 'No Result Found', 'id' => '']];
        }

        
    }
    public function result(Request $request) {
        $searchingdata = $request->input('search_product');
        $sanpham = SanPham::select('id', 'name', 'Gia', 'GiamGia', 'thumb', 'thuonghieu_id')
            ->where(function ($query) use ($searchingdata) {
                $query->where('name', 'LIKE', '%' . $searchingdata . '%')
                    ->orWhere('Code', 'LIKE', '%' . $searchingdata . '%');
            })
            ->where('active', '1')
            ->first();
    
        if ($sanpham) {
            if (isset($_POST['searchbtn'])) {
                return redirect('/san-pham/tim-kiem?q='.$searchingdata );
            } else {
                
                return redirect('/san-pham/' . $sanpham->id . '-' . Str::slug($sanpham->name, '-'));
            }
        } else {
            return redirect('/')->with('status', 'Product Not Available');
        }
    }
    

    public function loadProduct(Request $request)
    {
        $page = $request->input('page', 0);
        $result = $this->sanpham->get($page);
        if (count($result) != 0) {
            $html = view('products.list', ['products' => $result ])->render();

            return response()->json([ 'html' => $html ]);
        }

        return response()->json(['html' => '' ]);
    }
}
