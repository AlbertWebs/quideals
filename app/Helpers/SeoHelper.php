<?php

namespace App\Helpers;

use App\Models\Setting;
use Illuminate\Support\Str;

class SeoHelper
{
    public static function siteName(): string
    {
        return Setting::get('site_name', config('app.name', 'Qui Deals'));
    }

    public static function description(?string $text, int $length = 158): string
    {
        $clean = trim(preg_replace('/\s+/', ' ', strip_tags((string) $text)));

        if ($clean === '') {
            return 'Shop home and kitchen appliances in Kenya at ' . self::siteName() . '. Compare prices, check stock, and get fast delivery.';
        }

        return Str::limit($clean, $length, '');
    }

    public static function jsonLd(array $data): string
    {
        return '<script type="application/ld+json">'
            . json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP)
            . '</script>';
    }

    public static function brandName($product): string
    {
        if ($product->relationLoaded('brand') && $product->brand) {
            return $product->brand->name;
        }

        $legacy = $product->getAttributes()['brand'] ?? null;

        return $legacy ?: self::siteName();
    }
}
