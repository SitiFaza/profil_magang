<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin1',
            'email' => 'cacaanasya16@gmail.com',
            'password' => bcrypt('admin123'),
        ]);
    }
}
