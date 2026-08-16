<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $contactSettings = Setting::getGroup('contact');
        $socialSettings = Setting::getGroup('social');
        
        return view('admin.settings.index', compact('contactSettings', 'socialSettings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'settings' => 'required|array',
            'settings.*' => 'nullable|string|max:2000' // Increased for copyright and longer texts
        ]);

        foreach ($request->settings as $key => $value) {
            Setting::set($key, $value);
        }

        return back()->with('success', 'Settings updated successfully.');
    }

    public function updateLogo(Request $request)
    {
        $request->validate([
            'site_logo' => 'nullable|file|mimes:png,jpg,jpeg,svg,webp|max:2048',
            'site_logo_light' => 'nullable|file|mimes:png,jpg,jpeg,svg,webp|max:2048',
        ]);

        if ($request->hasFile('site_logo')) {
            $this->storeLogoFile($request, 'site_logo');
        }

        if ($request->hasFile('site_logo_light')) {
            $this->storeLogoFile($request, 'site_logo_light');
        }

        if (!$request->hasFile('site_logo') && !$request->hasFile('site_logo_light')) {
            return back()->withErrors(['site_logo' => 'Please choose a logo file to upload.']);
        }

        return back()->with('success', 'Logo updated successfully.');
    }

    private function storeLogoFile(Request $request, string $key): void
    {
        $previous = Setting::get($key);
        $path = $request->file($key)->store('logos', 'public');
        Setting::set($key, $path);

        if ($previous && $previous !== $path) {
            Storage::disk('public')->delete($previous);
        }
    }

    public function contact()
    {
        $contactSettings = Setting::getGroup('contact');
        return view('admin.settings.contact', compact('contactSettings'));
    }

    public function social()
    {
        $socialSettings = Setting::getGroup('social');
        return view('admin.settings.social', compact('socialSettings'));
    }
}
