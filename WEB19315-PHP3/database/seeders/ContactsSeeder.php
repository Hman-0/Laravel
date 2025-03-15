<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ContactsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contacts')->insert([
            [
                'name' => 'Nguyễn Văn A',
                'email' => 'hehe@gmail.com',
                'phone' => '0123456789',
                'title' => 'hehee',
                'content' => 'hdqwhqwudh',

            ],
            [
                'name' => 'Nguyễn Văn B',
                'email' => 'huhu@gmail.com',
                'phone' => '0123456789',
                'title' => 'huhu',
                'content' => 'hdqwhqwudh',
            ],
        ]);
    }
}
