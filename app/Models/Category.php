<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    //Để làm việc đc với Factory ta phải sử dụng thư viện HasFactory
    use HasFactory , SoftDeletes;
    // muốn model làm vc với bảng nào ta cần quy định trong thuộc tính table
    protected $table = 'categories';
    //muốn làm vc với Eloquent thì ta cần xác định các trường dữ liệu vào fillble
    protected $fillable = [
        'ten_danh_muc',
        'trang_thai'
    ];
    // tạo mối liên hệ với product
    public function products()
    {
        return $this->hasMany(Product::class , 'category_id' );
    }
}
