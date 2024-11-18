<?php


namespace App\Http\Services\SanPham;

use App\Models\Menu;
use App\Models\SanPham;
use Illuminate\Support\Facades\DB;

class SanPhamWebService
{
    const LIMIT = 15;

    public function get( $request,$page = null)
    {
        
        
        // select('id', 'name', 'Gia', 'GiamGia', 'thumb')
        //     ->orderByDesc('id')
        //     ->when($page != null, function ($query) use ($page) {
        //         $query->offset($page * self::LIMIT);
        //     })
        //     ->limit(self::LIMIT);
        
        $sanpham = SanPham::query();
        $sanpham->select('id', 'name', 'Gia', 'GiamGia', 'thumb','thuonghieu_id');
    
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
        
        // Điều kiện lọc theo thương hiệu
        if ($request->brands) {
            $f_brands = $request->query('brands');
            $sanpham->where(function($query) use ($f_brands) {
                $query->whereIn('thuonghieu_id', explode(',', $f_brands))
                      ->orWhereRaw("'".$f_brands."' = ''");
            });
        }
        $sanpham->with('ThuongHieu');
        $sanpham = $sanpham->paginate(9);
        return $sanpham;
    }
    public function getthsanpham()
    {
        return   SanPham::join('thuong_hieus', 'san_phams.thuonghieu_id', '=', 'thuong_hieus.id')
        ->select('thuong_hieus.name as brand_name', DB::raw('COUNT(san_phams.id) as product_count'))
        ->groupBy('thuong_hieus.id', 'thuong_hieus.name')
        ->orderByDesc('product_count')
        ->get();
       }
  
    public function getlq($menu , $thuonghieu)
    {
        return SanPham::select('id', 'name', 'Gia', 'GiamGia', 'thumb')
            ->where('menu_id', $menu)
            ->orWhere('thuonghieu_id', $thuonghieu)
            ->limit(self::LIMIT)
            ->get();
    }
    public function getgiamgia($request)
    {
        $sanpham = SanPham::query();
        $sanpham->select('id', 'name', 'Gia', 'GiamGia', 'thumb');
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

        $sanpham = $sanpham->paginate(9);
        return $sanpham;
    }
    public function show($id)
    {
        return SanPham::where('id', $id)
            ->where('active', 1)
            ->with('XuatXu','GioiTinh','DanhMuc','DoTuoi','ThuongHieu')
            ->firstOrFail();
    }
  
  
    public function showdanhmuc($id,$page = null)
    {   
        $childCategories = Menu::where('parent_id', $id)->get();
        $childCategoryIds = $childCategories->pluck('id');

        // Truy vấn sản phẩm từ các danh mục con
        $products = SanPham::select('id', 'name', 'Gia', 'GiamGia', 'thumb')->whereIn('menu_id', $childCategoryIds)->get();
        $productsFromParent = SanPham::select('id', 'name', 'Gia', 'GiamGia', 'thumb')->where('menu_id', $id)->get();
        $allProducts = $productsFromParent->merge($products);

        return $allProducts;
        // return SanPham::select('id', 'name', 'Gia', 'GiamGia', 'thumb')
        //     ->where('menu_id', $id)
        //     ->orderByDesc('id')
        //     ->when($page != null, function ($query) use ($page) {
        //         $query->offset($page * self::LIMIT);
        //     })
        //     ->limit(self::LIMIT)
        //     ->get();
    }
    public function showthuonghieu($request,$id,$page = null)
    {   
        $sanpham = SanPham::query();
        $sanpham->select('id', 'name', 'Gia', 'GiamGia', 'thumb','thuonghieu_id');
        $sanpham->where('thuonghieu_id',$id);
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
        $sanpham = $sanpham->paginate(9);
        return $sanpham;
    }
    public function more($id)
    {
        return SanPham::select('id', 'name', 'Gia', 'GiamGia', 'thumb')
            ->where('active', 1)
            ->where('id', '!=', $id)
            ->orderByDesc('id')
            ->limit(8)
            ->get();
    }
}
