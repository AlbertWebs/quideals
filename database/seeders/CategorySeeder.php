<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Women\'s Fashion',
                'slug' => 'womens-fashion',
                'icon' => 'fas fa-tshirt',
                'description' => 'Trendy women\'s clothing, dresses, and fashion items',
                'sort_order' => 1
            ],
            [
                'name' => 'Men\'s Fashion',
                'slug' => 'mens-fashion',
                'icon' => 'fas fa-user-tie',
                'description' => 'Stylish men\'s clothing, suits, and fashion essentials',
                'sort_order' => 2
            ],
            [
                'name' => 'Skincare',
                'slug' => 'skincare',
                'icon' => 'fas fa-spa',
                'description' => 'Premium skincare products for healthy, glowing skin',
                'sort_order' => 3
            ],
            [
                'name' => 'Makeup',
                'slug' => 'makeup',
                'icon' => 'fas fa-palette',
                'description' => 'High-quality makeup products and cosmetics',
                'sort_order' => 4
            ],
            [
                'name' => 'Accessories',
                'slug' => 'accessories',
                'icon' => 'fas fa-gem',
                'description' => 'Fashion accessories, jewelry, bags, and more',
                'sort_order' => 5
            ],
            [
                'name' => 'Fragrances',
                'slug' => 'fragrances',
                'icon' => 'fas fa-spray-can',
                'description' => 'Luxury perfumes and fragrances for men and women',
                'sort_order' => 6
            ],
            [
                'name' => 'Personal Care',
                'slug' => 'personal-care',
                'icon' => 'fas fa-pump-soap',
                'description' => 'Personal hygiene and care products for daily wellness',
                'sort_order' => 7
            ],
            [
                'name' => 'Shoes',
                'slug' => 'shoes',
                'icon' => 'fas fa-shoe-prints',
                'description' => 'Stylish footwear for men and women',
                'sort_order' => 8
            ],
            [
                'name' => 'Dresses',
                'slug' => 'dresses',
                'icon' => 'fas fa-tshirt',
                'description' => 'Beautiful dresses for every occasion',
                'sort_order' => 9
            ],
            [
                'name' => 'Handbags',
                'slug' => 'handbags',
                'icon' => 'fas fa-shopping-bag',
                'description' => 'Designer handbags and purses',
                'sort_order' => 10
            ],
            [
                'name' => 'Supplements',
                'slug' => 'supplements',
                'icon' => 'fas fa-capsules',
                'description' => 'Health and wellness supplements',
                'sort_order' => 11
            ]
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
