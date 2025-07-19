<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductCategory;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        ProductCategory::create([
            'name' => 'Fashion',
            'carbon_per_unit' => 2.5,
            'eco_suggestion' => 'Try thrift stores or eco-friendly brands.'
        ]);

        ProductCategory::create([
            'name' => 'Electronics',
            'carbon_per_unit' => 4.8,
            'eco_suggestion' => 'Buy energy-efficient or refurbished devices.'
        ]);

        ProductCategory::create([
            'name' => 'Groceries',
            'carbon_per_unit' => 0.9,
            'eco_suggestion' => 'Buy local and avoid plastic packaging.'
        ]);

        ProductCategory::create([
            'name' => 'Fast Food',
            'carbon_per_unit' => 3.1,
            'eco_suggestion' => 'Bring your own container or eat plant-based.'
        ]);

        ProductCategory::create([
            'name' => 'Transport',
            'carbon_per_unit' => 5.0,
            'eco_suggestion' => 'Try carpooling, biking or public transport.'
        ]);
    }
}
