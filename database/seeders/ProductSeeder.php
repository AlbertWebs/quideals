<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        // Available images to alternate between
        $images = [
            '/assets/images/1-DloPm3Vx.png',
            '/assets/images/3-BClu8jbQ.png',
            '/assets/images/4-BkO3CAjp.png',
            '/assets/images/7-CxEhnEfj.png',
            '/assets/images/10-kfJyDaBt.png'
        ];

        $products = [
            // Women's Fashion
            [
                'category_id' => $categories->where('slug', 'womens-fashion')->first()->id,
                'name' => 'Elegant Floral Summer Dress',
                'slug' => 'elegant-floral-summer-dress',
                'description' => 'Beautiful floral print summer dress perfect for any occasion',
                'price' => 8500.00,
                'old_price' => 12000.00,
                'image' => $images[0],
                'images' => [
                    $images[1],
                    $images[2],
                    $images[3],
                    $images[4]
                ],
                'badge' => 'SALE',
                'rating' => 5,
                'reviews_count' => 128,
                'stock_quantity' => 25,
                'is_featured' => true,
                'specifications' => [
                    'material' => '100% Cotton',
                    'size' => 'Available in S, M, L, XL',
                    'care' => 'Machine washable',
                    'style' => 'Casual/Formal'
                ]
            ],
            [
                'category_id' => $categories->where('slug', 'womens-fashion')->first()->id,
                'name' => 'Classic Black Blazer',
                'slug' => 'classic-black-blazer',
                'description' => 'Professional black blazer for office and formal events',
                'price' => 15000.00,
                'old_price' => 18000.00,
                'image' => $images[1],
                'images' => [
                    $images[2],
                    $images[3],
                    $images[4],
                    $images[0]
                ],
                'badge' => 'NEW',
                'rating' => 5,
                'reviews_count' => 95,
                'stock_quantity' => 20,
                'is_featured' => true,
                'specifications' => [
                    'material' => 'Polyester Blend',
                    'size' => 'Available in S, M, L, XL',
                    'care' => 'Dry clean only',
                    'style' => 'Formal'
                ]
            ],
            [
                'category_id' => $categories->where('slug', 'womens-fashion')->first()->id,
                'name' => 'Comfortable Denim Jeans',
                'slug' => 'comfortable-denim-jeans',
                'description' => 'Stylish and comfortable denim jeans for everyday wear',
                'price' => 4500.00,
                'image' => $images[2],
                'rating' => 4,
                'reviews_count' => 67,
                'stock_quantity' => 50,
                'specifications' => [
                    'material' => '98% Cotton, 2% Elastane',
                    'size' => 'Available in 28-38',
                    'care' => 'Machine washable',
                    'style' => 'Casual'
                ]
            ],

            // Men's Fashion
            [
                'category_id' => $categories->where('slug', 'mens-fashion')->first()->id,
                'name' => 'Premium Cotton T-Shirt',
                'slug' => 'premium-cotton-t-shirt',
                'description' => 'High-quality cotton t-shirt in various colors',
                'price' => 2500.00,
                'old_price' => 3500.00,
                'image' => $images[3],
                'images' => [
                    $images[4],
                    $images[0],
                    $images[1],
                    $images[2]
                ],
                'badge' => 'HOT',
                'rating' => 5,
                'reviews_count' => 234,
                'stock_quantity' => 100,
                'is_featured' => true,
                'specifications' => [
                    'material' => '100% Premium Cotton',
                    'size' => 'Available in S, M, L, XL, XXL',
                    'care' => 'Machine washable',
                    'style' => 'Casual'
                ]
            ],
            [
                'category_id' => $categories->where('slug', 'mens-fashion')->first()->id,
                'name' => 'Formal Business Suit',
                'slug' => 'formal-business-suit',
                'description' => 'Elegant two-piece business suit for professional occasions',
                'price' => 25000.00,
                'old_price' => 30000.00,
                'image' => $images[4],
                'badge' => 'SALE',
                'rating' => 5,
                'reviews_count' => 156,
                'stock_quantity' => 15,
                'is_featured' => true,
                'specifications' => [
                    'material' => 'Wool Blend',
                    'size' => 'Available in 38-48',
                    'care' => 'Dry clean only',
                    'style' => 'Formal'
                ]
            ],
            [
                'category_id' => $categories->where('slug', 'mens-fashion')->first()->id,
                'name' => 'Casual Chino Pants',
                'slug' => 'casual-chino-pants',
                'description' => 'Versatile chino pants perfect for smart casual wear',
                'price' => 5500.00,
                'image' => $images[0],
                'rating' => 4,
                'reviews_count' => 89,
                'stock_quantity' => 40,
                'specifications' => [
                    'material' => 'Cotton Twill',
                    'size' => 'Available in 30-40',
                    'care' => 'Machine washable',
                    'style' => 'Smart Casual'
                ]
            ],

            // Skincare
            [
                'category_id' => $categories->where('slug', 'skincare')->first()->id,
                'name' => 'Vitamin C Brightening Serum',
                'slug' => 'vitamin-c-brightening-serum',
                'description' => 'Powerful vitamin C serum for brightening and evening skin tone',
                'price' => 4500.00,
                'old_price' => 6000.00,
                'image' => $images[1],
                'images' => [
                    $images[2],
                    $images[3]
                ],
                'badge' => '-25%',
                'rating' => 5,
                'reviews_count' => 189,
                'stock_quantity' => 35,
                'is_featured' => true,
                'specifications' => [
                    'volume' => '30ml',
                    'skin_type' => 'All skin types',
                    'key_ingredient' => '20% Vitamin C',
                    'benefits' => 'Brightening, Anti-aging'
                ]
            ],
            [
                'category_id' => $categories->where('slug', 'skincare')->first()->id,
                'name' => 'Hyaluronic Acid Moisturizer',
                'slug' => 'hyaluronic-acid-moisturizer',
                'description' => 'Intensive hydrating moisturizer with hyaluronic acid',
                'price' => 3500.00,
                'image' => $images[2],
                'rating' => 5,
                'reviews_count' => 342,
                'stock_quantity' => 50,
                'is_featured' => true,
                'specifications' => [
                    'volume' => '50ml',
                    'skin_type' => 'Dry to Normal',
                    'key_ingredient' => 'Hyaluronic Acid',
                    'benefits' => 'Hydration, Plumping'
                ]
            ],
            [
                'category_id' => $categories->where('slug', 'skincare')->first()->id,
                'name' => 'Retinol Night Cream',
                'slug' => 'retinol-night-cream',
                'description' => 'Advanced anti-aging night cream with retinol',
                'price' => 6500.00,
                'old_price' => 8000.00,
                'image' => $images[3],
                'badge' => 'SALE',
                'rating' => 5,
                'reviews_count' => 267,
                'stock_quantity' => 28,
                'specifications' => [
                    'volume' => '50ml',
                    'skin_type' => 'Mature skin',
                    'key_ingredient' => '1% Retinol',
                    'benefits' => 'Anti-aging, Wrinkle reduction'
                ]
            ],

            // Makeup
            [
                'category_id' => $categories->where('slug', 'makeup')->first()->id,
                'name' => 'Matte Lipstick Set',
                'slug' => 'matte-lipstick-set',
                'description' => 'Long-lasting matte lipstick in 6 trendy shades',
                'price' => 5500.00,
                'old_price' => 7500.00,
                'image' => $images[4],
                'images' => [
                    $images[0],
                    $images[1],
                    $images[2]
                ],
                'badge' => 'HOT',
                'rating' => 5,
                'reviews_count' => 423,
                'stock_quantity' => 30,
                'is_featured' => true,
                'specifications' => [
                    'shades' => '6 colors',
                    'finish' => 'Matte',
                    'longevity' => '12 hours',
                    'formula' => 'Creamy, Non-drying'
                ]
            ],
            [
                'category_id' => $categories->where('slug', 'makeup')->first()->id,
                'name' => 'Full Coverage Foundation',
                'slug' => 'full-coverage-foundation',
                'description' => 'Buildable full coverage foundation for flawless skin',
                'price' => 4500.00,
                'image' => $images[0],
                'rating' => 4,
                'reviews_count' => 298,
                'stock_quantity' => 45,
                'is_featured' => true,
                'specifications' => [
                    'volume' => '30ml',
                    'coverage' => 'Full coverage',
                    'finish' => 'Natural matte',
                    'shades' => '15 shades available'
                ]
            ],
            [
                'category_id' => $categories->where('slug', 'makeup')->first()->id,
                'name' => 'Eyeshadow Palette',
                'slug' => 'eyeshadow-palette',
                'description' => 'Professional 12-shade eyeshadow palette',
                'price' => 3500.00,
                'old_price' => 5000.00,
                'image' => $images[1],
                'badge' => 'SALE',
                'rating' => 5,
                'reviews_count' => 187,
                'stock_quantity' => 38,
                'specifications' => [
                    'shades' => '12 colors',
                    'finish' => 'Matte & Shimmer',
                    'pigmentation' => 'Highly pigmented',
                    'formula' => 'Creamy, Blendable'
                ]
            ],

            // Accessories
            [
                'category_id' => $categories->where('slug', 'accessories')->first()->id,
                'name' => 'Leather Crossbody Bag',
                'slug' => 'leather-crossbody-bag',
                'description' => 'Stylish genuine leather crossbody bag with adjustable strap',
                'price' => 8500.00,
                'old_price' => 12000.00,
                'image' => $images[2],
                'badge' => 'NEW',
                'rating' => 5,
                'reviews_count' => 234,
                'stock_quantity' => 20,
                'is_featured' => true,
                'specifications' => [
                    'material' => 'Genuine Leather',
                    'size' => 'Medium (30cm x 20cm)',
                    'color' => 'Black, Brown, Tan',
                    'features' => 'Adjustable strap, Multiple compartments'
                ]
            ],
            [
                'category_id' => $categories->where('slug', 'accessories')->first()->id,
                'name' => 'Silver Pendant Necklace',
                'slug' => 'silver-pendant-necklace',
                'description' => 'Elegant sterling silver pendant necklace',
                'price' => 4500.00,
                'image' => $images[3],
                'rating' => 4,
                'reviews_count' => 156,
                'stock_quantity' => 60,
                'specifications' => [
                    'material' => 'Sterling Silver',
                    'length' => '45cm chain',
                    'pendant' => 'Heart-shaped',
                    'care' => 'Tarnish-resistant'
                ]
            ],
            [
                'category_id' => $categories->where('slug', 'accessories')->first()->id,
                'name' => 'Designer Sunglasses',
                'slug' => 'designer-sunglasses',
                'description' => 'UV protection sunglasses with polarized lenses',
                'price' => 5500.00,
                'old_price' => 7500.00,
                'image' => $images[4],
                'badge' => 'SALE',
                'rating' => 5,
                'reviews_count' => 189,
                'stock_quantity' => 35,
                'specifications' => [
                    'lens' => 'Polarized',
                    'uv_protection' => '100% UV400',
                    'frame' => 'Acetate',
                    'style' => 'Aviator, Wayfarer, Cat-eye'
                ]
            ],

            // Fragrances
            [
                'category_id' => $categories->where('slug', 'fragrances')->first()->id,
                'name' => 'Women\'s Floral Perfume',
                'slug' => 'womens-floral-perfume',
                'description' => 'Luxurious floral fragrance with notes of rose and jasmine',
                'price' => 12000.00,
                'old_price' => 15000.00,
                'image' => $images[0],
                'images' => [
                    $images[1],
                    $images[2]
                ],
                'badge' => 'SALE',
                'rating' => 5,
                'reviews_count' => 312,
                'stock_quantity' => 25,
                'is_featured' => true,
                'specifications' => [
                    'volume' => '100ml',
                    'notes' => 'Rose, Jasmine, Vanilla',
                    'longevity' => '8-10 hours',
                    'type' => 'Eau de Parfum'
                ]
            ],
            [
                'category_id' => $categories->where('slug', 'fragrances')->first()->id,
                'name' => 'Men\'s Woody Cologne',
                'slug' => 'mens-woody-cologne',
                'description' => 'Bold and masculine cologne with woody and spicy notes',
                'price' => 11000.00,
                'old_price' => 14000.00,
                'image' => $images[1],
                'badge' => 'NEW',
                'rating' => 5,
                'reviews_count' => 278,
                'stock_quantity' => 22,
                'is_featured' => true,
                'specifications' => [
                    'volume' => '100ml',
                    'notes' => 'Cedar, Bergamot, Amber',
                    'longevity' => '10-12 hours',
                    'type' => 'Eau de Toilette'
                ]
            ],
            [
                'category_id' => $categories->where('slug', 'fragrances')->first()->id,
                'name' => 'Unisex Fresh Fragrance',
                'slug' => 'unisex-fresh-fragrance',
                'description' => 'Light and fresh unisex fragrance perfect for everyday wear',
                'price' => 9500.00,
                'image' => $images[2],
                'rating' => 4,
                'reviews_count' => 145,
                'stock_quantity' => 30,
                'specifications' => [
                    'volume' => '100ml',
                    'notes' => 'Citrus, Green Tea, White Musk',
                    'longevity' => '6-8 hours',
                    'type' => 'Eau de Parfum'
                ]
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
