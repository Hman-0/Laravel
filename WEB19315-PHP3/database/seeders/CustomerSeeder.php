<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customers')->insert([
            [
                'ten_khach_hang' => 'Nguyễn Văn A',
                'email' => 'manh@gmail.com',
                'password' => '123456',
                'phone' => '0123456789',
                'address' => 'Hà Nội',
            ],
            [
                'ten_khach_hang' => 'Nguyễn Văn B',
                'email' => 'tuananh@gmail.com',
                'password' =>'123456',
                'phone' => '0123456789',
                'address' => 'Hà Nội',
            ],
        ]);

    }
}
