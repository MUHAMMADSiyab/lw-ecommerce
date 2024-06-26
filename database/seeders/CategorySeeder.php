<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('categories')->truncate();

        $categories = [
            // Top-level categories (with subcategories)
            [
                'name' => 'Electronics',
                'parent_id' => null,
            ],
            [
                'name' => 'Fashion',
                'parent_id' => null,
            ],
            [
                'name' => 'Home & Garden',
                'parent_id' => null,
            ],
            [
                'name' => 'Sports & Outdoors',
                'parent_id' => null,
            ],

            // Subcategories for Electronics
            [
                'name' => 'Televisions',
                'parent_id' => 1, // Electronics
            ],
            [
                'name' => 'Computers & Laptops',
                'parent_id' => 1, // Electronics
            ],
            [
                'name' => 'Cell Phones & Accessories',
                'parent_id' => 1, // Electronics
            ],

            // Subcategories for Fashion
            [
                'name' => 'Men\'s Clothing',
                'parent_id' => 2, // Fashion
            ],
            [
                'name' => 'Women\'s Clothing',
                'parent_id' => 2, // Fashion
            ],
            [
                'name' => 'Shoes',
                'parent_id' => 2, // Fashion
            ],

            // Subcategories for Home & Garden
            [
                'name' => 'Kitchen Appliances',
                'parent_id' => 3, // Home & Garden
            ],
            [
                'name' => 'Furniture',
                'parent_id' => 3, // Home & Garden
            ],
            [
                'name' => 'Gardening Tools',
                'parent_id' => 3, // Home & Garden
            ],

            // Subcategories for Sports & Outdoors
            [
                'name' => 'Fitness Equipment',
                'parent_id' => 4, // Sports & Outdoors
            ],
            [
                'name' => 'Camping Gear',
                'parent_id' => 4, // Sports & Outdoors
            ],
            [
                'name' => 'Outdoor Apparel',
                'parent_id' => 4, // Sports & Outdoors
            ],

            // Categories without parent (adjust category names as needed)
            [
                'name' => 'Books',
                'parent_id' => null,
            ],
            [
                'name' => 'Toys',
                'parent_id' => null,
            ],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert($category);
        }
    }
}
