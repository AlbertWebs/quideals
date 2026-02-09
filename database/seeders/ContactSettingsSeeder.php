<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class ContactSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contactSettings = [
            [
                'key' => 'contact_phone',
                'value' => '+254 700 123 456',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Contact Phone',
                'description' => 'Main contact phone number'
            ],
            [
                'key' => 'contact_email',
                'value' => 'hello@gurudigital.co.ke',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Contact Email',
                'description' => 'Main contact email address'
            ],
            [
                'key' => 'contact_address',
                'value' => 'Westlands, Nairobi',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Contact Address',
                'description' => 'Physical address'
            ],
            [
                'key' => 'contact_city',
                'value' => 'Kenya',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Contact City',
                'description' => 'City and country'
            ],
            [
                'key' => 'business_hours_weekdays',
                'value' => 'Monday - Friday: 8:00 AM - 6:00 PM',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Weekday Hours',
                'description' => 'Business hours for weekdays'
            ],
            [
                'key' => 'business_hours_saturday',
                'value' => 'Saturday: 9:00 AM - 4:00 PM',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Saturday Hours',
                'description' => 'Business hours for Saturday'
            ],
            [
                'key' => 'business_hours_sunday',
                'value' => 'Sunday: Closed',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Sunday Hours',
                'description' => 'Business hours for Sunday'
            ],
            [
                'key' => 'social_facebook',
                'value' => '#',
                'type' => 'text',
                'group' => 'social',
                'label' => 'Facebook URL',
                'description' => 'Facebook page URL'
            ],
            [
                'key' => 'social_twitter',
                'value' => '#',
                'type' => 'text',
                'group' => 'social',
                'label' => 'Twitter URL',
                'description' => 'Twitter profile URL'
            ],
            [
                'key' => 'social_instagram',
                'value' => '#',
                'type' => 'text',
                'group' => 'social',
                'label' => 'Instagram URL',
                'description' => 'Instagram profile URL'
            ],
            [
                'key' => 'social_linkedin',
                'value' => '#',
                'type' => 'text',
                'group' => 'social',
                'label' => 'LinkedIn URL',
                'description' => 'LinkedIn profile URL'
            ],
            [
                'key' => 'whatsapp_number',
                'value' => '+254700123456',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'WhatsApp Number',
                'description' => 'WhatsApp number for order notifications (include country code, e.g., +254700123456)'
            ],
            // Footer Settings
            [
                'key' => 'site_name',
                'value' => 'Quideals',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Site Name',
                'description' => 'Website/Company name'
            ],
            [
                'key' => 'footer_free_delivery_title',
                'value' => 'FREE DELIVERY',
                'type' => 'text',
                'group' => 'footer',
                'label' => 'Free Delivery Title',
                'description' => 'Title for free delivery section in footer'
            ],
            [
                'key' => 'footer_free_delivery_text',
                'value' => 'On orders over KES 5,000',
                'type' => 'text',
                'group' => 'footer',
                'label' => 'Free Delivery Text',
                'description' => 'Description for free delivery section'
            ],
            [
                'key' => 'footer_secure_checkout_title',
                'value' => 'SECURE CHECKOUT',
                'type' => 'text',
                'group' => 'footer',
                'label' => 'Secure Checkout Title',
                'description' => 'Title for secure checkout section in footer'
            ],
            [
                'key' => 'footer_secure_checkout_text',
                'value' => 'Shop safely and confidently',
                'type' => 'text',
                'group' => 'footer',
                'label' => 'Secure Checkout Text',
                'description' => 'Description for secure checkout section'
            ],
            [
                'key' => 'footer_easy_returns_title',
                'value' => 'EASY RETURNS',
                'type' => 'text',
                'group' => 'footer',
                'label' => 'Easy Returns Title',
                'description' => 'Title for easy returns section in footer'
            ],
            [
                'key' => 'footer_easy_returns_text',
                'value' => '15-day return window',
                'type' => 'text',
                'group' => 'footer',
                'label' => 'Easy Returns Text',
                'description' => 'Description for easy returns section'
            ],
            [
                'key' => 'footer_customer_care_title',
                'value' => 'CUSTOMER CARE',
                'type' => 'text',
                'group' => 'footer',
                'label' => 'Customer Care Title',
                'description' => 'Title for customer care section in footer'
            ],
            [
                'key' => 'footer_customer_care_text',
                'value' => 'We\'re here 24/7',
                'type' => 'text',
                'group' => 'footer',
                'label' => 'Customer Care Text',
                'description' => 'Description for customer care section'
            ],
            [
                'key' => 'footer_subscribe_title',
                'value' => 'SUBSCRIBE',
                'type' => 'text',
                'group' => 'footer',
                'label' => 'Subscribe Section Title',
                'description' => 'Title for subscribe section in footer'
            ],
            [
                'key' => 'footer_subscribe_text',
                'value' => 'Get the latest trends, beauty tips, and exclusive offers delivered to your inbox.',
                'type' => 'textarea',
                'group' => 'footer',
                'label' => 'Subscribe Section Text',
                'description' => 'Description text for subscribe section'
            ],
            [
                'key' => 'footer_copyright',
                'value' => '© 2025 Quideals. Designed & Developed by <a href="https://designekta.com" target="_blank" class="text-white hover:text-pink-400 transition-colors">Designekta Studios</a>.',
                'type' => 'textarea',
                'group' => 'footer',
                'label' => 'Copyright Text',
                'description' => 'Copyright text for footer (HTML allowed)'
            ]
        ];

        foreach ($contactSettings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
