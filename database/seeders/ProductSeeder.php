<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Product::create([
            'name' => 'iPhone 15 Pro',
            'price' => 25000000,
            'category_id' => 1,
            'stock' => 10
        ]);

        \App\Models\Product::create([
            'name' => 'Samsung Galaxy S24',
            'price' => 20000000,
            'category_id' => 1,
            'stock' => 15
        ]);

        \App\Models\Product::create([
            'name' => 'MacBook Pro 16"',
            'price' => 50000000,
            'category_id' => 2,
            'stock' => 5
        ]);

        \App\Models\Product::create([
            'name' => 'Dell XPS 13',
            'price' => 35000000,
            'category_id' => 2,
            'stock' => 8
        ]);

        \App\Models\Product::create([
            'name' => 'Tai nghe AirPods Pro',
            'price' => 5000000,
            'category_id' => 3,
            'stock' => 20
        ]);
    }
}
