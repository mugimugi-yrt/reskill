<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 100; $i++) {
            $product = new \App\Models\Product([
                'name' => 'サンプル商品' . $i,
                'category_id' => rand(1, 7),
                'price' => rand(10, 50) * 10,
            ]);
            $product->save();
        }
    }
}
