<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Category::create(['name' => 'Điện thoại', 'description' => 'Các loại điện thoại di động']);
        \App\Models\Category::create(['name' => 'Laptop', 'description' => 'Máy tính xách tay']);
        \App\Models\Category::create(['name' => 'Phụ kiện', 'description' => 'Phụ kiện công nghệ']);
    }
}
