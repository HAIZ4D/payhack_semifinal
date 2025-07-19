<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create(['name' => 'Eraser', 'category' => 'Groceries', 'price' => 0.99]);
        Product::create(['name' => 'Mouse', 'category' => 'Electronics', 'price' => 35.50]);
        Product::create(['name' => 'T-Shirt', 'category' => 'Fashion', 'price' => 25.70]);
        Product::create(['name' => 'Burger', 'category' => 'Fast Food', 'price' => 12.65,'eco_points' => 10,]);
        Product::create(['name' => 'Train Ticket', 'category' => 'Transport', 'price' => 3.80, 'eco_points' => 20,]);
    }
}
