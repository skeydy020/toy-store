<?php

use App\Http\Controllers\Admin\AnhController;
use App\Http\Controllers\Admin\DanhMucController;
use App\Http\Controllers\Admin\DanhMucTinController;
use App\Http\Controllers\Admin\DoTuoiController;
use App\Http\Controllers\Admin\BaoCaoController;
use App\Http\Controllers\Admin\GioiTinhController;
use App\Http\Controllers\Admin\LoaiSanPhamController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\SanPhamController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ThuonghieuController;
use App\Http\Controllers\Admin\TinTucController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\Users\RegisterController;
use App\Http\Controllers\Admin\XuatXuController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;


Route::get('admin/users/login', [LoginController::class, 'index'])->name('login');
Route::post('admin/users/login/store', [LoginController::class, 'store']);

Route::get('admin/users/login/register', [RegisterController::class, 'index'])->name('register');
Route::post('admin/users/login/register/store', [RegisterController::class, 'store']);
Route::get('admin/redirect/{provider}', [LoginController::class, 'redirect']);
Route::get('admin/callback/{provider}', [LoginController::class, 'callback']);

Route::middleware(['auth'])->group(function () {

    Route::prefix('admin')->group(function () {

        Route::get('/', [MainController::class, 'index'])->name('admin');
        Route::get('main', [MainController::class, 'index']);

          #Menu
        Route::prefix('menus')->group(function () {
          Route::get('add', [MenuController::class, 'create']);
          Route::post('add', [MenuController::class, 'store']);
          Route::get('list', [MenuController::class, 'index']);
          Route::get('edit/{menu}', [MenuController::class, 'show']);
          Route::post('edit/{menu}', [MenuController::class, 'update']);
          Route::DELETE('destroy', [MenuController::class, 'destroy']);
      });

         #slider
         Route::prefix('sliders')->group(function () {
            Route::get('add', [SliderController::class, 'create']);
            Route::post('add', [SliderController::class, 'store']);
            Route::get('list', [SliderController::class, 'index']);
            Route::get('edit/{slider}', [SliderController::class, 'show']);
            Route::post('edit/{slider}', [SliderController::class, 'update']);
            Route::DELETE('destroy', [SliderController::class, 'destroy']);
        });
          #thuonghieu
          Route::prefix('thuonghieus')->group(function () {
            Route::get('add', [ThuonghieuController::class, 'create']);
            Route::post('add', [ThuonghieuController::class, 'store']);
            Route::get('list', [ThuonghieuController::class, 'index']);
            Route::get('edit/{thuonghieu}', [ThuonghieuController::class, 'show']);
            Route::post('edit/{thuonghieu}', [ThuonghieuController::class, 'update']);
            Route::DELETE('destroy', [ThuonghieuController::class, 'destroy']);
        });
        #DoTuoi
        Route::prefix('dotuois')->group(function () {
          Route::get('add', [DoTuoiController::class, 'create']);
          Route::post('add', [DoTuoiController::class, 'store']);
          Route::get('list', [DoTuoiController::class, 'index']);
          Route::get('edit/{dotuoi}', [DoTuoiController::class, 'show']);
          Route::post('edit/{dotuoi}', [DoTuoiController::class, 'update']);
          Route::DELETE('destroy', [DoTuoiController::class, 'destroy']);
      });
        #GioiTinh
        Route::prefix('gioitinhs')->group(function () {
          Route::get('add', [GioiTinhController::class, 'create']);
          Route::post('add', [GioiTinhController::class, 'store']);
          Route::get('list', [GioiTinhController::class, 'index']);
          Route::get('edit/{gioitinh}', [GioiTinhController::class, 'show']                                       );
          Route::post('edit/{gioitinh}', [GioiTinhController::class, 'update']);
          Route::DELETE('destroy', [GioiTinhController::class, 'destroy']);
      });
        #DoTuoi
        Route::prefix('xuatxus')->group(function () {
          Route::get('add', [XuatXuController::class, 'create']);
          Route::post('add', [XuatXuController::class, 'store']);
          Route::get('list', [XuatXuController::class, 'index']);
          Route::get('edit/{xuatxu}', [XuatXuController::class, 'show']);
          Route::post('edit/{xuatxu}', [XuatXuController::class, 'update']);
          Route::DELETE('destroy', [XuatXuController::class, 'destroy']);
      });
        #Sản phẩm
        Route::prefix('sanphams')->group(function () {
          Route::get('add', [SanPhamController::class, 'create']);
          Route::post('add', [SanPhamController::class, 'store']);
          Route::get('list', [SanPhamController::class, 'index']);
          Route::get('edit/{sanpham}', [SanPhamController::class, 'show']);
          Route::post('edit/{sanpham}', [SanPhamController::class, 'update']);
          Route::DELETE('destroy', [SanPhamController::class, 'destroy']);
      });  
         #ảnh Sản phẩm
         Route::prefix('anhs')->group(function () {
          Route::get('add', [AnhController::class, 'create']);
          Route::post('add', [AnhController::class, 'store']);
          Route::post('addsanpham/{sanpham}', [AnhController::class, 'store2']);
          Route::get('list', [AnhController::class, 'index']);
          Route::get('listanh/{sanpham}', [AnhController::class, 'sanpham']);
          Route::get('edit/{anh}', [AnhController::class, 'show']);
          Route::post('edit/{anh}', [AnhController::class, 'update']);
          Route::DELETE('destroy', [AnhController::class, 'destroy']);
      });
       #Danh mục tin
      Route::prefix('danhmuctins')->group(function () {
        Route::get('add', [DanhMucTinController::class, 'create']);
        Route::post('add', [DanhMucTinController::class, 'store']);
        Route::get('list', [DanhMucTinController::class, 'index']);
        Route::get('edit/{danhmuctin}', [DanhMucTinController::class, 'show']);
        Route::post('edit/{danhmuctin}', [DanhMucTinController::class, 'update']);
        Route::DELETE('destroy', [DanhMucTinController::class, 'destroy']);
    });
       #tin tức
       Route::prefix('tintucs')->group(function () {
        Route::get('add', [TinTucController::class, 'create']);
        Route::post('add', [TinTucController::class, 'store']);
        Route::get('list', [TinTucController::class, 'index']);
        Route::get('edit/{tintuc}', [TinTucController::class, 'show']);
        Route::post('edit/{tintuc}', [TinTucController::class, 'update']);
        Route::DELETE('destroy', [TinTucController::class, 'destroy']);
    });
    #user
    Route::prefix('users')->group(function () {
      Route::get('add', [UserController::class, 'create']);
      Route::post('add', [UserController::class, 'store']);
      Route::get('list', [UserController::class, 'index']);
      Route::get('edit/{user}', [UserController::class, 'show']);
      Route::post('edit/{user}', [UserController::class, 'update']);
      Route::DELETE('destroy', [UserController::class, 'destroy']);
  });
        #Upload
        Route::post('upload/services', [UploadController::class, 'store']);

        #Cart
        Route::get('donhangs', [\App\Http\Controllers\Admin\DonHangController::class, 'index']);
        Route::get('donhangs/edit/{donhang}', [\App\Http\Controllers\Admin\DonHangController::class, 'edit']);
        Route::post('donhangs/edit/{donhang}', [\App\Http\Controllers\Admin\DonHangController::class, 'update']);
        Route::get('donhangs/{donhang}', [\App\Http\Controllers\Admin\DonHangController::class, 'show']);
        Route::DELETE('donhangs/destroy', [\App\Http\Controllers\Admin\DonHangController::class, 'destroy']);
         });
});

Route::get('/', [App\Http\Controllers\MainController::class, 'index'])->name('home');
Route::post('/services/load-product', [App\Http\Controllers\MainController::class, 'loadProduct']);

Route::get('/tim-kiem-ajax', [App\Http\Controllers\MainController::class, 'Searchautocomplate'])->name('timkiemajax');
Route::post('/tim-kiem', [App\Http\Controllers\MainController::class, 'result']);


Route::get('san-pham', [App\Http\Controllers\SanPhamController::class, 'list'])->name('san-pham');;
Route::get('san-pham/tim-kiem', [App\Http\Controllers\SanPhamController::class, 'timkiem']);
Route::get('san-pham-khuyen-mai', [App\Http\Controllers\SanPhamController::class, 'listgiamgia']);
Route::get('san-pham/{id}-{slug}', [App\Http\Controllers\SanPhamController::class, 'index']);
Route::get('danh-muc/{id}-{slug}', [App\Http\Controllers\SanPhamController::class, 'danhmuc']);

Route::post('add-cart', [App\Http\Controllers\GioHangController::class, 'index']);
Route::get('add-cart/{id}', [App\Http\Controllers\GioHangController::class, 'addCartHome']);
Route::get('carts', [App\Http\Controllers\GioHangController::class, 'show']);
Route::post('update-cart', [App\Http\Controllers\GioHangController::class, 'update']);
Route::get('carts/delete/{id}', [App\Http\Controllers\GioHangController::class, 'remove']);
Route::post('carts', [App\Http\Controllers\GioHangController::class, 'addCart']);

Route::get('tai-khoan', [App\Http\Controllers\TaiKhoanController::class, 'index']);
Route::post('tai-khoan', [App\Http\Controllers\TaiKhoanController::class, 'update']);
Route::get('tai-khoan/lich-su-mua-hang', [App\Http\Controllers\TaiKhoanController::class, 'lichsu']);
Route::get('tai-khoan/lich-su-mua-hang/{donhang}', [App\Http\Controllers\TaiKhoanController::class, 'show']);
Route::get('tai-khoan/doi-mat-khau', [App\Http\Controllers\TaiKhoanController::class, 'change']);
Route::post('tai-khoan/doi-mat-khau', [App\Http\Controllers\TaiKhoanController::class, 'store']);
Route::get('dang-xuat', [App\Http\Controllers\TaiKhoanController::class, 'logout']);

Route::get('don-hang', [App\Http\Controllers\DonHangController::class, 'index']);


Route::get('thuong-hieu', [BrandController::class, 'index']);
Route::get('thuong-hieu/{id}-{slug}', [BrandController::class, 'list']);
Route::prefix('tin-tuc')->group(function(){
  Route::get('/', [NewsController::class, 'index'])->name('tin-tuc');
  Route::get('chi-tiet', action: [NewsController::class, 'detail'])->name('tin-tuc.chi-tiet');
});

// Place `BaoCaoController` route inside existing middleware group if not defined
Route::middleware(['auth'])->prefix('admin')->group(function () {
  // Only one occurrence of BaoCaoController route
  Route::get('baocao', [BaoCaoController::class, 'index'])->name('baocao.index');
});
