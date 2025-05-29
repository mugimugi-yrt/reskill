<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'チョコレート'],
            ['name' => 'ガム'],
            ['name' => 'スナック'],
            ['name' => 'アイス'],
            ['name' => 'クッキー'],
            ['name' => 'せんべい'],
            ['name' => '珍味']
        ];
        \DB::table('categories')->insert($data);
    }
}
