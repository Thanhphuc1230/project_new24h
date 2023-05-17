<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now()->toDateTimeString();

        // Create admin account
        DB::table('users')->insert([
            'uuid' => Uuid::uuid4()->toString(),
            'fullname' => 'Admin',
            'phone' => '0123456789',
            'email' => 'admin@gmail.com',
            'email_verified_at' =>$now,
            'password' => Hash::make('@admin123'),
            'level' => '1',
            'avatar' => null,
            'created_at' => $now,
        ]);
    }
}
