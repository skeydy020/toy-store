<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThuVienAnh extends Model
{
    use HasFactory;
    protected $fillable =[
        'sanpham_id',
        'thumb',
        'active'];
    public function SanPham()
    {
        return $this->hasOne(SanPham::class, 'id', 'sanpham_id')
            ->withDefault(['name' => '']);
    }
}
