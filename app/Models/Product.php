<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    //
    use HasFactory , SoftDeletes;
    protected $table = 'products';
    protected $fillable = [
        'ma_san_pham',
        'ten_san_pham',
        'category_id',
        'gia_san_pham',
        'giam_gia',
        'img',
        'so_luong',
        'ngay_nhap_kho',
        'mo_ta',
        'trang_thai',
    ];
    protected $dates = ['deleted_at'];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id')->select('id', 'ten_danh_muc');
    }
    
}
