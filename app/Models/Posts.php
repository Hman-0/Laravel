<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Posts extends Model
{
    use HasFactory , SoftDeletes;
    protected $table = 'posts';

    protected $fillable = [
        'title',
        'content',
        'image',
        'category_id',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id')->select('id', 'ten_danh_muc');
    }
}
