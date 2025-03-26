<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reviews')->insert([
            [
                'name' => 'Nguyễn Văn A',
                'email' => 'ahsda@gmail.com',
                'phone' => '0123456789',
                'content' => 'hdqwhqwudh',
                'rating' => 5,
            ],
            [
                'name' => 'Nguyễn Văn B',
                'email' => 'hahsh@gmail.com',
                'phone' => '01244456789',
                'content' => 'hdqwhqwudh',
                'rating' => 4,
            ],
        ]);
    }
}
