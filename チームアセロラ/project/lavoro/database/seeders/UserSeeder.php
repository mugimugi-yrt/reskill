<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $testAdminUser = [
                'name' => 'Admin User',
                'ruby' => 'あどみん ゆーざー',
                'password' => Hash::make('himitu'),
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'two_factor_confirmed_at' => null,
                'email' => 'admin@example.com',
                'tel' => '09000000000',
                'company' => 'Admin Company',
                'birthday' => '1980-01-01',
                'address' => '160-0004, 東京都, 新宿区四谷, ４－２８－４, ＹＫＢエンサインビル 10F',
                'gender' => '男',
                'get_notice' => true,
                'is_admin' => true,
                'is_deleted' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ];

        $testUser = [
                'name' => 'Normal User',
                'ruby' => 'のーまる ゆーざー',
                'password' => Hash::make('himitu'),
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'two_factor_confirmed_at' => null,
                'email' => 'user@example.com',
                'tel' => '08011111111',
                'company' => 'User Company',
                'birthday' => '1990-05-05',
                'address' => '160-0004, 東京都, 新宿区四谷, ４－２８－４, ＹＫＢエンサインビル 10F',
                'gender' => '女',
                'get_notice' => false,
                'is_admin' => false,
                'is_deleted' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ];

        $testDeletedUser = [
                'name' => 'Deleted User',
                'ruby' => 'でりーと ゆーざー',
                'password' => Hash::make('password'),
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'two_factor_confirmed_at' => null,
                'email' => 'deleted@example.com',
                'tel' => '07022222222',
                'company' => 'Deleted Company',
                'birthday' => '1975-12-12',
                'address' => '160-0004, 東京都, 新宿区四谷, ４－２８－４, ＹＫＢエンサインビル 10F',
                'gender' => '回答しない',
                'get_notice' => false,
                'is_admin' => false,
                'is_deleted' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        
        \DB::table('users')->insert($testAdminUser);
        \DB::table('users')->insert($testUser);
        \DB::table('users')->insert($testDeletedUser);
    }
}
