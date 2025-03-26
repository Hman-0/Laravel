<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('products')->insert([
        //    [
        //     'ma_san_pham'  => 'SP001',
        //     'ten_san_pham' => 'iPhone 15 Pro',
        //     'gia_san_pham' => 29990000,
        //     'giam_gia'     => 1000000,
        //     'so_luong'     => 50,
        //     'ngay_nhap_kho'=> '2025-03-01',
        //     'mo_ta'        => 'Điện thoại iPhone 15 Pro mới nhất',
        //     'trang_thai'   => true,
        //    ],
        //    [
        //     'ma_san_pham'  => 'SP002',
        //     'ten_san_pham' => 'Samsung Galaxy S30',
        //     'gia_san_pham' => 19990000,
        //     'giam_gia'     => 500000,
        //     'so_luong'     => 100,
        //     'ngay_nhap_kho'=> '2025-03-01',
        //     'mo_ta'        => 'Điện thoại Samsung Galaxy S30 mới nhất',
        //     'trang_thai'   => true,
        //    ]
        // ]);
        Category::factory()->count(5)->create()->each(function ($category) {
            Product::factory()->count(10)->create([
                'category_id' => $category->id
            ]);
         });
    }
}
