<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CarouselSlide;

class CarouselSlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $slides = [
            [
                'title' => 'New Fashion Collection',
                'description' => 'Discover the latest trends in women\'s and men\'s fashion',
                'image' => null, // Will be uploaded through admin panel
                'button_text' => 'Shop Now',
                'button_link' => '/products',
                'background_color' => 'blue',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Beauty Essentials',
                'description' => 'Premium skincare and makeup products for your beauty routine',
                'image' => null, // Will be uploaded through admin panel
                'button_text' => 'Explore',
                'button_link' => '/products',
                'background_color' => 'pink',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Summer Sale',
                'description' => 'Up to 30% off on fashion, accessories, and beauty products',
                'image' => null, // Will be uploaded through admin panel
                'button_text' => 'Shop Sale',
                'button_link' => '/products',
                'background_color' => 'purple',
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($slides as $slide) {
            CarouselSlide::create($slide);
        }
    }
}
