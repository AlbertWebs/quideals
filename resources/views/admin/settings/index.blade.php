@extends('layouts.admin')

@php
use App\Models\Setting;
@endphp

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Site Settings</h1>
        <p class="text-gray-600 mt-2">Manage your website settings and contact information</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Contact Settings -->
        <div class="bg-white border border-gray-200 rounded-lg p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold text-gray-900">Contact Information</h2>
                <a href="{{ route('admin.settings.contact') }}" class="text-brand-green hover:text-brand-navy text-sm font-medium">
                    Edit →
                </a>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="text-sm font-medium text-gray-600">Site Name</label>
                    <p class="text-gray-900 font-semibold">{{ Setting::get('site_name', config('app.name', 'Home & Kitchen Appliances')) }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-600">Phone</label>
                    <p class="text-gray-900">{{ Setting::get('contact_phone', 'Not set') }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-600">Email</label>
                    <p class="text-gray-900">{{ Setting::get('contact_email', 'Not set') }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-600">Address</label>
                    <p class="text-gray-900">{{ Setting::get('contact_address', 'Not set') }}, {{ Setting::get('contact_city', 'Not set') }}</p>
                </div>
            </div>
        </div>

        <!-- Social Media Settings -->
        <div class="bg-white border border-gray-200 rounded-lg p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold text-gray-900">Social Media</h2>
                <a href="{{ route('admin.settings.social') }}" class="text-brand-green hover:text-brand-navy text-sm font-medium">
                    Edit →
                </a>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="text-sm font-medium text-gray-600">Facebook</label>
                    <p class="text-gray-900">{{ Setting::get('social_facebook', 'Not set') }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-600">Twitter</label>
                    <p class="text-gray-900">{{ Setting::get('social_twitter', 'Not set') }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-600">Instagram</label>
                    <p class="text-gray-900">{{ Setting::get('social_instagram', 'Not set') }}</p>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-600">LinkedIn</label>
                    <p class="text-gray-900">{{ Setting::get('social_linkedin', 'Not set') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-8 bg-white border border-gray-200 rounded-lg p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-2">Site Logo</h2>
        <p class="text-sm text-gray-600 mb-6">Upload a transparent PNG or SVG. The header uses the main logo; the footer and admin sidebar can use a light version for dark backgrounds.</p>

        <form action="{{ route('admin.settings.logo') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-3">Main logo</label>
                <div class="flex items-center justify-center h-28 mb-4 rounded-lg border border-gray-200 bg-white p-4">
                    <img src="{{ Setting::logoUrl() }}" alt="Current logo" class="max-h-20 w-auto object-contain">
                </div>
                <input type="file" name="site_logo" accept="image/png,image/jpeg,image/svg+xml,image/webp"
                       class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-brand-green-light file:text-brand-navy file:font-medium hover:file:bg-brand-green-soft">
                @error('site_logo')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-3">Light logo (optional)</label>
                <div class="flex items-center justify-center h-28 mb-4 rounded-lg border border-gray-200 bg-brand-navy p-4">
                    <img src="{{ Setting::logoUrl('light') }}" alt="Current light logo" class="max-h-20 w-auto object-contain">
                </div>
                <input type="file" name="site_logo_light" accept="image/png,image/jpeg,image/svg+xml,image/webp"
                       class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-brand-green-light file:text-brand-navy file:font-medium hover:file:bg-brand-green-soft">
                <p class="mt-2 text-xs text-gray-500">Used on navy backgrounds. If empty, the main logo is used.</p>
                @error('site_logo_light')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="md:col-span-2">
                <button type="submit" class="bg-brand-green text-white px-5 py-2.5 rounded-lg font-semibold hover:bg-brand-deep-green transition-colors">
                    Save logo
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 