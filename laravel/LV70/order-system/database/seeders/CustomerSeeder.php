<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DateTime;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => '山田太郎', 'created_at' => new DateTime(), 'updated_at' => new DateTime()],
            ['name' => '鈴木花子', 'created_at' => new DateTime(), 'updated_at' => new DateTime()],
            ['name' => '田中次郎', 'created_at' => new DateTime(), 'updated_at' => new DateTime()],
            ['name' => '吉田芳子', 'created_at' => new DateTime(), 'updated_at' => new DateTime()],
            ['name' => '渡辺吾郎', 'created_at' => new DateTime(), 'updated_at' => new DateTime()],
        ];
        \DB::table('customers')->insert($data);
    }
}
