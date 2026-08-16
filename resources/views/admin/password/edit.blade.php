@extends('layouts.admin')

@section('title', 'Change Password')

@section('content')
<div class="max-w-xl">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-brand-navy">Change Password</h1>
        <p class="text-gray-600 mt-1">Update the password for {{ auth()->user()->email }}</p>
    </div>

    <div class="bg-white border border-gray-200 rounded-lg p-6">
        <form method="POST" action="{{ route('admin.password.update') }}" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="current_password" class="block text-sm font-medium text-brand-navy mb-1">Current Password</label>
                <input id="current_password"
                       type="password"
                       name="current_password"
                       required
                       autocomplete="current-password"
                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-green/30 focus:border-brand-green">
                @error('current_password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-brand-navy mb-1">New Password</label>
                <input id="password"
                       type="password"
                       name="password"
                       required
                       autocomplete="new-password"
                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-green/30 focus:border-brand-green">
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-brand-navy mb-1">Confirm New Password</label>
                <input id="password_confirmation"
                       type="password"
                       name="password_confirmation"
                       required
                       autocomplete="new-password"
                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-green/30 focus:border-brand-green">
            </div>

            <div class="pt-2">
                <button type="submit" class="bg-brand-green text-white px-5 py-2.5 rounded-lg font-semibold hover:bg-brand-deep-green transition-colors">
                    Update Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
