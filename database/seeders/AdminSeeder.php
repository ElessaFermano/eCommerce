<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Elessa',
                'role' => 'admin',
                'address' =>'Hilongos',
                'phone' => '09987645332',
                'email' => 'elessa@gmail.com',
                'password' => Hash::make('12345678'),

            ]
        ]);
    }
}
