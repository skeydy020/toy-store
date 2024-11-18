<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    use HasFactory;
    protected $fillable =[
        'Code',
        'name',
        'thumb',
        'description',
        'Gia',
        'GiamGia',
        'menu_id',
        'dotuoi_id',
        'gioitinh_id',
        'thuonghieu_id',
        'xuatxu_id',
        'SoLuong',
        'content',
        'active'
    ];
    public function DanhMuc()
    {
        return $this->hasOne(Menu::class, 'id', 'menu_id')
            ->withDefault(['name' => '']);
    }
    public function DoTuoi()
    {
        return $this->hasOne(DoTuoi::class, 'id', 'dotuoi_id')
            ->withDefault(['name' => '']);
    }
    public function ThuongHieu()
    {
        return $this->hasOne(ThuongHieu::class, 'id', 'thuonghieu_id')
            ->withDefault(['name' => '']);
    }
    public function GioiTinh()
    {
        return $this->hasOne(GioiTinh::class, 'id', 'gioitinh_id')
            ->withDefault(['name' => '']);
    }
    public function XuatXu()
    {
        return $this->hasOne(XuatXu::class, 'id', 'xuatxu_id')
            ->withDefault(['name' => '']);
    }

    public static function DemSanPhamDanhMuc($menu_id){
        $sldanhmuc=SanPham::where('menu_id',$menu_id)->where('status',1)->count();
        return $sldanhmuc;
    }
}
