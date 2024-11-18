<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietDonHang extends Model
{
    use HasFactory;
    protected $fillable =[
        'donhang_id',
        'sanpham_id',
        'Gia',
        'SoLuong'];
    public function SanPham()
    {
        return $this->hasOne(SanPham::class, 'id', 'sanpham_id');
    }
}
