<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        for($i = 11; $i <= 30;$i++){
            DB::table('users')->insert([
                'uuid' => Str::uuid(),
                'fullname' => 'Admin'.$i,
                'phone' => '0123456789'.$i,
                'email' => 'admin@gmail.com'.$i,
                'email_verified_at' =>new \DateTime(),
                'password' => Hash::make('@admin123'),
                'level' => '2',
                'avatar' => null,
                'created_at' => new \DateTime(),
            ]);
        }
        
    }
}
