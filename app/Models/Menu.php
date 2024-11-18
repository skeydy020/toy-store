<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'thumb',
        'parent_id',
        'description',
        'content',
        'slug',
        'active'
    ];
    public function products()
    {
        return $this->hasMany(SanPham::class);
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }
}
