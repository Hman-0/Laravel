<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('banners')->insert([
            [
                'ten_banner' => 'Banner 1',
                'anh' => 'banner1.jpg',
                'link' => 'https://www.google.com',
            ],
            [
                'ten_banner' => 'Banner 2',
                'anh' => 'banner2.jpg',
                'link' => 'https://www.google.com',
            ],
        ]);
    }
}
