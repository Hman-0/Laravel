<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Banner extends Model
{
    use SoftDeletes , HasFactory; 
    protected $table = 'banners';

    protected $fillable = [
        'ten_banner',
        'anh',
        'link',
    ];
    
}
