<?php

namespace App\Http\Controllers;

use App\Http\Services\Anh\AnhService;
use App\Http\Services\GioHangService;
use App\Http\Services\Menu\MenuService;
use Illuminate\Http\Request;
use App\Http\Services\Product\ProductService;
use App\Http\Services\SanPham\SanPhamWebService;
use App\Models\Menu;
use App\Models\SanPham;
use App\Models\ThuongHieu;

class SanPhamController extends Controller
{
    protected $SanPhamWebService;
    protected $giohang;
    protected $menuservice;
    protected $anh;
    public function __construct(SanPhamWebService $SanPhamWebService, GioHangService $giohang,AnhService $anh
    ,MenuService $menuservice)
    {
        $this->SanPhamWebService = $SanPhamWebService;
        $this->giohang = $giohang;
        $this->menuservice = $menuservice;
        $this->anh = $anh;
    }

    public function index($id = '', $slug = '')
    {
         $sanpham = $this->SanPhamWebService->show($id);
         $splienquan = $this->SanPhamWebService->getlq($sanpham->menu_id, $sanpham->thuonghieu_id);
        // $productsMore = $this->SanPhamWebService->more($id);
        $anhs = $this->anh->show($id);
        return view('sanphams.content', [
            'title' => $sanpham->name,
            'sanphamgiohangs' => $this->giohang->getSanPham(),
            'anhs' => $anhs,
            'splienquans' => $splienquan,
             'sanpham' => $sanpham
            // 'products' => $productsMore
        ]);
    }
    public function list(Request $request)
    {   
        $sanpham = SanPham::query();
        $sanpham->select('id', 'name', 'Gia', 'GiamGia', 'thumb','thuonghieu_id','dotuoi_id','gioitinh_id');
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
         if ($request->brands) {
             $f_brands = $request->query('brands');
             $sanpham->where(function($query) use ($f_brands) {
                 $query->whereIn('thuonghieu_id', explode(',', $f_brands))
                       ->orWhereRaw("'".$f_brands."' = ''");
             });
         }
         $sanpham->with('ThuongHieu');
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
         $brandCounts = [];
         $dotuoiCounts = [];
         $gioitinhCounts = [];
         foreach ($sanphamList as $sp) {
             $brandId = $sp->thuonghieu_id;
             $dotuoiId = $sp->dotuoi_id;
             $gioitinhId = $sp->gioitinh_id;
             $brandName = $sp->thuonghieu->name ?? 'Không xác định'; // lấy tên thương hiệu
             if (isset($brandCounts[$brandId])) {
                 $brandCounts[$brandId]['count']++;
             } else {
                 $brandCounts[$brandId] = [
                     'name' => $brandName,
                     'count' => 1
                 ];
             }
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
         $f_brands = $request->query('brands');$f_dotuois = $request->query('dotuoi');$f_gioitinhs = $request->query('gioitinh');	
        return view('sanphams.list', [
            'title' => 'Danh sách sản phẩm',    
            'menus'=>$this->menuservice->danhmuc(),
            'sanphamgiohangs' => $this->giohang->getSanPham(),
             'sanphams' => $sanpham,
             'brandCounts' => $brandCounts,
             'dotuoiCounts' => $dotuoiCounts,
             'gioitinhCounts' => $gioitinhCounts,
             'f_gioitinhs' => $f_gioitinhs,
             'f_brands' => $f_brands,
             'f_dotuois' => $f_dotuois
            // 'products' => $productsMore
        ]);


        
    }
/////////////////////////////////////////////////////////////////////





/////////////////////////////////////////////////////////////////////
    public function danhmuc(Request $request,$id = '', $slug = '')
    {
        $sanpham = SanPham::query();
        $sanpham->select('id', 'name', 'Gia', 'GiamGia', 'thumb','thuonghieu_id','dotuoi_id','gioitinh_id');$sanpham->where('active', '1');
        $sanpham->where(function ($query) use ($id) {
            $query->where('menu_id', $id)
                  ->orWhereIn('menu_id', Menu::where('parent_id', $id)->pluck('id'));
        });
        
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
        if ($request->brands) {
            $f_brands = $request->query('brands');
            $sanpham->where(function($query) use ($f_brands) {
                $query->whereIn('thuonghieu_id', explode(',', $f_brands))
                      ->orWhereRaw("'".$f_brands."' = ''");
            });
        }
        $sanpham->with('ThuongHieu');
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
        $brandCounts = [];
        $dotuoiCounts = [];
        $gioitinhCounts = [];
        foreach ($sanphamList as $sp) {
            $brandId = $sp->thuonghieu_id;
            $dotuoiId = $sp->dotuoi_id;
            $gioitinhId = $sp->gioitinh_id;
            $brandName = $sp->thuonghieu->name ?? 'Không xác định'; // lấy tên thương hiệu
            if (isset($brandCounts[$brandId])) {
                $brandCounts[$brandId]['count']++;
            } else {
                $brandCounts[$brandId] = [
                    'name' => $brandName,
                    'count' => 1
                ];
            }
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
        $f_brands = $request->query('brands');$f_dotuois = $request->query('dotuoi');$f_gioitinhs = $request->query('gioitinh');		
        return view('sanphams.list', [
            'title' => 'Danh sách sản phẩm',    
            'menus'=>$this->menuservice->danhmuc(),
            'sanphamgiohangs' => $this->giohang->getSanPham(),
             'sanphams' => $sanpham,
             'brandCounts' => $brandCounts,
             'dotuoiCounts' => $dotuoiCounts,
             'gioitinhCounts' => $gioitinhCounts,
             'f_gioitinhs' => $f_gioitinhs,
             'f_brands' => $f_brands,
             'f_dotuois' => $f_dotuois
            // 'products' => $productsMore
        ]);

    }
    public function timkiem(Request $request){
        $sanpham = SanPham::query();
        $sanpham->select('id', 'name', 'Gia', 'GiamGia', 'thumb','thuonghieu_id','dotuoi_id','gioitinh_id');$sanpham->where('active', '1');
        if ($request->q) {
            $q = $request->q;
            $sanpham->where(function ($query) use ($q) {
                $query->where('name', 'LIKE', '%' . $q . '%')
                    ->orWhere('Code', 'LIKE', '%' . $q . '%');
            });
            
           
        }
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
         if ($request->brands) {
             $f_brands = $request->query('brands');
             $sanpham->where(function($query) use ($f_brands) {
                 $query->whereIn('thuonghieu_id', explode(',', $f_brands))
                       ->orWhereRaw("'".$f_brands."' = ''");
             });
         }
         $sanpham->with('ThuongHieu');
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
         $brandCounts = [];
         $dotuoiCounts = [];
         $gioitinhCounts = [];
         foreach ($sanphamList as $sp) {
             $brandId = $sp->thuonghieu_id;
             $dotuoiId = $sp->dotuoi_id;
             $gioitinhId = $sp->gioitinh_id;
             $brandName = $sp->thuonghieu->name ?? 'Không xác định'; // lấy tên thương hiệu
             if (isset($brandCounts[$brandId])) {
                 $brandCounts[$brandId]['count']++;
             } else {
                 $brandCounts[$brandId] = [
                     'name' => $brandName,
                     'count' => 1
                 ];
             }
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
         $f_brands = $request->query('brands');$f_dotuois = $request->query('dotuoi');$f_gioitinhs = $request->query('gioitinh');
        return view('sanphams.list', [
            'title' => 'Danh sách sản phẩm',    
            'menus'=>$this->menuservice->danhmuc(),
            'sanphamgiohangs' => $this->giohang->getSanPham(),
             'sanphams' => $sanpham,
             'brandCounts' => $brandCounts,
             'dotuoiCounts' => $dotuoiCounts,
             'gioitinhCounts' => $gioitinhCounts,
             'f_gioitinhs' => $f_gioitinhs,
             'f_brands' => $f_brands,
             'f_dotuois' => $f_dotuois
            // 'products' => $productsMore
        ]);
    }

    public function listgiamgia(Request $request)
    {
        //  $sanpham = $this->SanPhamWebService->getgiamgia($request);
        // // $productsMore = $this->SanPhamWebService->more($id);
        $sanpham = SanPham::query();
        $sanpham->select('id', 'name', 'Gia', 'GiamGia', 'thumb','thuonghieu_id','dotuoi_id','gioitinh_id');$sanpham->where('active', '1');
        $sanpham->where('GiamGia', '>', 0);
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
                    $sanpham->orderBy('GiamGia','ASC');
                    break;
                case 'giagiam':
                    $sanpham->orderBy('GiamGia','DESC');
                    break;
                case 'desc':
                    $sanpham->orderBy('id','DESC');
                    break;
                }
        }
        if ($request->price) {
            $price = $request->price;
            switch ($price) {
                case '0':
                    
                    break;
                case '1':
                    $sanpham->where('GiamGia', '<', 200000);
                    break;
        
                case '2':
                    $sanpham->WhereBetween('GiamGia', [200000, 500000]);
                    break;
        
                case '3':
                    $sanpham->WhereBetween('GiamGia', [500000, 1000000]);
                    break;
        
                case '4':
                    $sanpham->WhereBetween('GiamGia', [1000000, 2000000]);
                    break;
                case '5':
                    $sanpham->Where('GiamGia', '>', 2000000); 
                    break;
            }
        }
         /////clone////////////////////
         $sanphamList = clone $sanpham;
         // Điều kiện lọc theo thương hiệu
         if ($request->brands) {
             $f_brands = $request->query('brands');
             $sanpham->where(function($query) use ($f_brands) {
                 $query->whereIn('thuonghieu_id', explode(',', $f_brands))
                       ->orWhereRaw("'".$f_brands."' = ''");
             });
         }
         $sanpham->with('ThuongHieu');
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
         $brandCounts = [];
         $dotuoiCounts = [];
         $gioitinhCounts = [];
         foreach ($sanphamList as $sp) {
             $brandId = $sp->thuonghieu_id;
             $dotuoiId = $sp->dotuoi_id;
             $gioitinhId = $sp->gioitinh_id;
             $brandName = $sp->thuonghieu->name ?? 'Không xác định'; // lấy tên thương hiệu
             if (isset($brandCounts[$brandId])) {
                 $brandCounts[$brandId]['count']++;
             } else {
                 $brandCounts[$brandId] = [
                     'name' => $brandName,
                     'count' => 1
                 ];
             }
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
         $f_brands = $request->query('brands');$f_dotuois = $request->query('dotuoi');$f_gioitinhs = $request->query('gioitinh');
        return view('sanphams.listgiamgia', [
            'title' => 'Danh sách sản phẩm',    
            'menus'=>$this->menuservice->danhmuc(),
            'sanphamgiohangs' => $this->giohang->getSanPham(),
             'sanphamgiamgias' => $sanpham,
             'brandCounts' => $brandCounts,
             'dotuoiCounts' => $dotuoiCounts,
             'gioitinhCounts' => $gioitinhCounts,
             'f_gioitinhs' => $f_gioitinhs,
             'f_brands' => $f_brands,
             'f_dotuois' => $f_dotuois
            // 'products' => $productsMore
        ]);

    }
}
