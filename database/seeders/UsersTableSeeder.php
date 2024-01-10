<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('users')->insert([

           [
               'name'=> 'Admin',
               'username'=> 'admin',
               'email' => 'admin@gmail.com',
               'password' => Hash::make('11111'),
               'role' => 'admin',
               'balance'=>'12345',
               'status' => 'active',
               'currency' => 'EUR',
           ] ,

            [
                'name'=> 'User',
                'username'=> 'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('22222'),
                'role' => 'user',
                'balance'=> '10000',
                'status' => 'active',
                'currency' => 'EUR',
            ]
        ]);
    }
}
