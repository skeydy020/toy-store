<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TinTuc extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'thumb',
        'description',
        'danhmuc_id',
        'user_id',
        'content',
        'active'];
    public function DanhMucTinTuc()
    {
        return $this->hasOne(DanhMucTinTuc::class, 'id', 'danhmuc_id')
            ->withDefault(['name' => '']);
    }
}
