<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Services\Thuonghieu\ThuonghieuService;
use Illuminate\Http\Request;
use App\Models\ThuongHieu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Http\Services\GioHangService;
use App\Http\Services\Menu\MenuService;
use App\Http\Services\SanPham\SanPhamWebService;
use App\Models\SanPham;

class BrandController extends Controller
{
    protected $thuonghieu;
    protected $GioHangService;
    protected $SanPhamWebService;
    protected $menuservice;

    public function __construct(ThuonghieuService $thuonghieu, SanPhamWebService $SanPhamWebService,GioHangService $GioHangService,
    MenuService $menuservice)
    {
        $this->thuonghieu = $thuonghieu;
        $this->GioHangService = $GioHangService;
        $this->menuservice = $menuservice;
        $this->SanPhamWebService = $SanPhamWebService;
    }

    public function index()
    {      
        $sanphams = $this->GioHangService->getSanPham();
        return view('thuonghieu.brand', [
            'title' => 'Danh Sách Thương Hiệu Mới Nhất',
            'thuonghieus' => $this->thuonghieu
                            ->getAll()
                            ->filter(function($thuonghieu){
                                return boolval($thuonghieu->active) === true;
                            })
                            ->values(), // đánh lại index của collection
            'sanphamgiohangs' => $sanphams,
        ]);
    }
    public function list(Request $request, $id = '', $slug = '')
    {
        $sanpham = SanPham::query();
        $sanpham->select('id', 'name', 'Gia', 'GiamGia', 'thumb','thuonghieu_id','dotuoi_id','gioitinh_id');
        $sanpham->where('thuonghieu_id',$id);
        $sanpham->where('active', '1');
        if ($request->orderby) {
            $orderby = $request->orderby;
            switch ($orderby) {
                case 'az':
                    $sanpham->orderBy('name','ASC');
                    break;
                case 'za':
                    $sanpham->orderBy('name','DESC');
                    break;
                case 'giatang':
                    $sanpham->orderBy('Gia','ASC');
                    break;
                case 'giagiam':
                    $sanpham->orderBy('Gia','DESC');
                    break;
                case 'desc':
                    $sanpham->orderBy('id','DESC');
                    break;
                }
        }
        if ($request->price) {
            $price = $request->price;
            $sanpham->where(function($query) use ($price) {
                switch ($price) {
                    case '1':
                        $query->where('Gia', '<', 200000)
                              ->orWhere(function($q) {
                                  $q->where('GiamGia', '<', 200000)
                                    ->where('GiamGia', '>', 0);
                              });
                        break;
                    case '2':
                        $query->whereBetween('Gia', [200000, 500000])
                              ->where('GiamGia', '=', 0)
                              ->orWhereBetween('GiamGia', [200000, 500000]);
                        break;
                    case '3':
                        $query->whereBetween('Gia', [500000, 1000000])
                              ->where('GiamGia', '=', 0)
                              ->orWhereBetween('GiamGia', [500000, 1000000]);
                        break;
                    case '4':
                        $query->whereBetween('Gia', [1000000, 2000000])
                              ->where('GiamGia', '=', 0)
                              ->orWhereBetween('GiamGia', [1000000, 2000000]);
                        break;
                    case '5':
                        $query->where('Gia', '>', 2000000)
                              ->orWhere('GiamGia', '>', 2000000);
                        break;
                }
            });
        }
         /////clone////////////////////
         $sanphamList = clone $sanpham;
         // Điều kiện lọc theo thương hiệu
        
         if ($request->dotuoi) {
             $f_dotuois = $request->query('dotuoi');
             $sanpham->where(function($query) use ($f_dotuois) {
                 $query->whereIn('dotuoi_id', explode(',', $f_dotuois))
                       ->orWhereRaw("'".$f_dotuois."' = ''");
             });
         }
         $sanpham->with('DoTuoi');
         if ($request->gioitinh) {
             $f_gioitinhs = $request->query('gioitinh');
             $sanpham->where(function($query) use ($f_gioitinhs) {
                 $query->whereIn('gioitinh_id', explode(',', $f_gioitinhs))
                       ->orWhereRaw("'".$f_gioitinhs."' = ''");
             });
         }
         $sanpham->with('GioiTinh');
         // $sanpham = $sanpham->get();
         // $sanpham = $this->SanPhamWebService->get($request);
         ///////////////////////////////////////////////////////////////////////////////////
         
         $sanphamList = $sanphamList->get();
         
         $dotuoiCounts = [];
         $gioitinhCounts = [];
         foreach ($sanphamList as $sp) {
             
             $dotuoiId = $sp->dotuoi_id;
             $gioitinhId = $sp->gioitinh_id;
            
             $dotuoiName = $sp->dotuoi->name ?? 'Không xác định'; // lấy tên thương hiệu
             if (isset($dotuoiCounts[$dotuoiId])) {
                 $dotuoiCounts[$dotuoiId]['count']++;
             } else {
                 $dotuoiCounts[$dotuoiId] = [
                     'name' => $dotuoiName,
                     'count' => 1
                 ];
             }
             $gioitinhName = $sp->gioitinh->name ?? 'Không xác định'; // lấy tên thương hiệu
             if (isset($gioitinhCounts[$gioitinhId])) {
                 $gioitinhCounts[$gioitinhId]['count']++;
             } else {
                 $gioitinhCounts[$gioitinhId] = [
                     'name' => $gioitinhName,
                     'count' => 1
                 ];
             }
         }
         $sanpham = $sanpham->paginate(9);
         // $productsMore = $this->SanPhamWebService->more($id);
        $f_dotuois = $request->query('dotuoi');$f_gioitinhs = $request->query('gioitinh');
        return view('thuonghieu.list', [ 
            'title' => 'Danh sách sản phẩm ',
            'menus'=>$this->menuservice->danhmuc(),
            'sanphamgiohangs' => $this->GioHangService->getSanPham(),
             'sanphams' => $sanpham,
             'dotuoiCounts' => $dotuoiCounts,
             'gioitinhCounts' => $gioitinhCounts,
             'f_gioitinhs' => $f_gioitinhs,
          
             'f_dotuois' => $f_dotuois
        ]);
    }
}