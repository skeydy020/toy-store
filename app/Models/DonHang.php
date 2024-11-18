<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id',
        'pttt_id',
        'TenKH',
        'DiaChiNhanHang',
        'SDT',
        'GhiChu',
        'TTDonHang',
        'TongTien'];
        
        public function NguoiDung()
        {
            return $this->hasOne(User::class, 'id', 'user_id')
                ->withDefault(['name' => '']);
        }
        public function PTTT()
        {
            return $this->hasOne(PTThanhToan::class, 'id', 'pttt_id')
                ->withDefault(['TenPt' => '']);
        }
       
        public function ChiTietDonHang()
        {
            return $this->hasMany(ChiTietDonHang::class, 'donhang_id', 'id');
        }
}
