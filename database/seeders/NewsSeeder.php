<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        for ($j = 0; $j <= 10; $j++) {
         for ($i = 0; $i <= 10; $i++) {
            DB::table('news')->insert([
                'uuid' => Str::uuid(),
                'title' => 'News ' . $i .' + ' . $j,
                'avatar' => 'download.jpg',
                'intro' => 'This is news ' . $i.' + ' . $j,
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'author' => 'DTP',
                'status' => 1,
                'where_in' => $i ,
                'category_id' => $i,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => null,
            ]);
        };
    };
    }
}
