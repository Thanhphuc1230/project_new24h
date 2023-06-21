<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('staff_position')->insert([
            [
                'uuid' => \Str::uuid(),
                'position' => 'Kiểm duyệt',
                'status_position' => '1',
                'created_at' => new \DateTime(),
            ],
            [
                'uuid' => \Str::uuid(),
                'position' => 'Đăng bài',
                'status_position' => '1',
                'created_at' => new \DateTime(),
            ]
        ]);
        
    }
}
