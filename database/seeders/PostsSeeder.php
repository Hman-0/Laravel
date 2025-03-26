<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('posts')->insert([
            [
                'title' => 'Post 1',
                'content' => 'Content 1',
                'image'=>'image1.jpg',
                'category_id' => 1,
            ],
            [
                'title' => 'Post 2',
                'content' => 'Content 2',
                'image'=>'imagcce1.jpg',
                'category_id' => 2,
            ],
        ]);
    }
}
