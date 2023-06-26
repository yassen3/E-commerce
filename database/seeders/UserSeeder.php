<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=>'user',
            'email'=>'user@yahoo.com',
            'phone'=>'012345678',
            'password'=>'12345678',
            'usertype'=>'0',
        ]);

        User::create([
            'name'=>'admin',
            'email'=>'admin@yahoo.com',
            'phone'=>'013345678',
            'password'=>'12345678',
            'usertype'=>'1',
        ]);
    }
}