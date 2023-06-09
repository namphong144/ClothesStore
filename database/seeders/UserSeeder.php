<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Phùng Thu Huyền',
                'email' => 'huyenha200204@gmail.com',
                'password' => Hash::make('123456'),
            ],
            [
                'id' => 2,
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456'),
            ],
            [
                'id' => 3,
                'name' => 'Nguyễn Nam Phong',
                'email' => 'namphong@gmail.com',
                'password' => Hash::make('123456'),
            ],
          
        ]);
    }
}