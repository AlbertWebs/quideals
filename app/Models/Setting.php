<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'label',
        'description'
    ];

    protected $casts = [
        'value' => 'string',
    ];

    public static function get($key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    public static function set($key, $value)
    {
        $setting = static::where('key', $key)->first();
        
        if ($setting) {
            $setting->update(['value' => $value]);
        } else {
            static::create([
                'key' => $key,
                'value' => $value,
                'label' => ucwords(str_replace('_', ' ', $key)),
                'type' => 'text',
                'group' => 'general'
            ]);
        }
        
        return $setting;
    }

    public static function getGroup($group)
    {
        return static::where('group', $group)->get();
    }

    public static function getAllAsArray()
    {
        return static::pluck('value', 'key')->toArray();
    }

    public static function logoUrl(string $variant = 'default'): string
    {
        $key = $variant === 'light' ? 'site_logo_light' : 'site_logo';
        $path = static::get($key);

        if ($path) {
            return asset('storage/' . ltrim($path, '/'));
        }

        if ($variant === 'light') {
            $fallbackPath = static::get('site_logo');
            if ($fallbackPath) {
                return asset('storage/' . ltrim($fallbackPath, '/'));
            }

            return asset('images/logo-white.svg');
        }

        return asset('images/logo.svg');
    }
}
