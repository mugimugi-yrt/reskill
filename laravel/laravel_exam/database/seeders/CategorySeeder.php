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
            ['name' => 'スナック'],
            ['name' => 'アイス'],
            ['name' => '駄菓子'],
        ];
        \DB::table('categories')->insert($data);
    }
}
