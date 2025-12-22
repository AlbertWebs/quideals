<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            [
                'name' => 'Lyons',
                'description' => 'Premium kitchen appliances and home essentials',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Samsung',
                'description' => 'Innovative home appliances and electronics',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Von',
                'description' => 'Quality kitchen and home appliances',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'LG',
                'description' => 'Smart home appliances and electronics',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Whirlpool',
                'description' => 'Reliable home appliances for modern living',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Bosch',
                'description' => 'German-engineered kitchen and home appliances',
                'is_active' => true,
                'sort_order' => 6,
            ],
            [
                'name' => 'Panasonic',
                'description' => 'Innovative kitchen appliances and electronics',
                'is_active' => true,
                'sort_order' => 7,
            ],
            [
                'name' => 'Sharp',
                'description' => 'Quality home appliances and electronics',
                'is_active' => true,
                'sort_order' => 8,
            ],
            [
                'name' => 'Philips',
                'description' => 'Premium kitchen appliances and home essentials',
                'is_active' => true,
                'sort_order' => 9,
            ],
            [
                'name' => 'Kenwood',
                'description' => 'Professional kitchen appliances and mixers',
                'is_active' => true,
                'sort_order' => 10,
            ],
            [
                'name' => 'KitchenAid',
                'description' => 'Premium kitchen appliances and stand mixers',
                'is_active' => true,
                'sort_order' => 11,
            ],
            [
                'name' => 'Russell Hobbs',
                'description' => 'Affordable kitchen appliances and kettles',
                'is_active' => true,
                'sort_order' => 12,
            ],
            [
                'name' => 'Morphy Richards',
                'description' => 'Stylish kitchen appliances and home essentials',
                'is_active' => true,
                'sort_order' => 13,
            ],
            [
                'name' => 'Prestige',
                'description' => 'Quality cookware and kitchen appliances',
                'is_active' => true,
                'sort_order' => 14,
            ],
            [
                'name' => 'Tefal',
                'description' => 'Non-stick cookware and kitchen appliances',
                'is_active' => true,
                'sort_order' => 15,
            ],
            [
                'name' => 'Braun',
                'description' => 'German precision kitchen appliances',
                'is_active' => true,
                'sort_order' => 16,
            ],
            [
                'name' => 'Delonghi',
                'description' => 'Italian coffee machines and kitchen appliances',
                'is_active' => true,
                'sort_order' => 17,
            ],
            [
                'name' => 'Midea',
                'description' => 'Affordable and reliable home appliances',
                'is_active' => true,
                'sort_order' => 18,
            ],
            [
                'name' => 'Hisense',
                'description' => 'Smart home appliances and electronics',
                'is_active' => true,
                'sort_order' => 19,
            ],
            [
                'name' => 'Haier',
                'description' => 'Innovative home appliances and refrigerators',
                'is_active' => true,
                'sort_order' => 20,
            ],
        ];

        foreach ($brands as $brandData) {
            $brandData['slug'] = Str::slug($brandData['name']);
            Brand::create($brandData);
        }
    }
}
