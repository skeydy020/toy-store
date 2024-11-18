<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PTThanhToan extends Model
{
    use HasFactory;
    protected $fillable =[
        'TenPt',
        'MoTa',
        'KichHoat'];
}
